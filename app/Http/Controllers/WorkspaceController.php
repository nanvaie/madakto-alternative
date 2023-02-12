<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workspace_user;
use Illuminate\Http\Request;
use App\Models\Workspace;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;

class WorkspaceController extends Controller
{
    public function store(Request $request)
    {

        $key = 'token_key';
        $request->validate([
            "name" => ["required", 'min:2', 'max:63'],


        ]);
        $workspace = new Workspace();
        $workspace->name = $request->name;

        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $workspace->user_id = $decoded->user_id;
        $is_admin = $decoded->is_admin;
        if (!$is_admin) {
            return response()->json(["you are not admin"], 400);
        } else {
            $workspace->save();

            return response()->json(["success"], 200);
        }

    }

    public function edit($id)
    {
        $workspace = Workspace::find($id);
        return response()->json(["name" => $workspace->name,
            "id" => $workspace->id], 200);

    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => ["required", 'min:2', 'max:63']
        ]);
        Workspace::where('id', $request->id)->first()->update(['name' => $request->name]);
        return response()->json(["success"], 200);
    }

    public function show(Request $request)
    {

//        $key = 'token_key';
//        $jwt = $request->token;
//
//        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
//
//        $is_admin = $decoded->is_admin;
//        if (!$is_admin) {
//            return response()->json(["you are not admin"], 400);
//        } else {
        $workspace = Workspace::with('user')->get();
        return response()->json($workspace, 200);
//        }

    }


    public function user_list()
    {
        $users = User::all();
        return response()->json($users, 200);

    }

    public function assignmentUserToWorkspace(Request $request)
    {
        $key = 'token_key';
        $workspace_user = new Workspace_user();
        $workspace_user->user_id = $request->user_id_selected;
        $workspace_user->workspace_id = $request->workspace_id_selected;
        $workspace_user->owner = $request->owner;

        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        $is_admin = $decoded->is_admin;
        if (!$is_admin) {
            return response()->json(["you are not admin"], 400);
        } else {
            $workspace_user->save();

            return response()->json(["success"], 200);
        }

    }


}
