<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkspaceRequest;
use App\Models\User;
use App\Models\Workspace_user;
use Illuminate\Http\Request;
use App\Models\Workspace;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Gate;


class WorkspaceController extends ApiController
{
    public function store(WorkspaceRequest $request)
    {
        $key = 'token_key';
        $workspace = new Workspace();
        $workspace->name = $request->name;
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $workspace->user_id = $decoded->user_id;
        $workspace->save();
        return $this->successResponse("success", 201);
    }

    public function edit($id)
    {
        $workspace = Workspace::findOrfail($id);
        return $this->successResponse(["name" => $workspace->name,"id" => $workspace->id], 200);
    }

    public function update(WorkspaceRequest $request)
    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $workspace = Workspace::find($request->id);
        $workspace->user_id = $decoded->user_id;

        if(Gate::allows('update',$workspace)){
            Workspace::where('id', $request->id)->first()->update(['name' => $request->name]);
            return $this->successResponse("success", 200);
        }
        else{
            return $this->errorResponse("unauthorized",403);
        }
    }

    public function show(Request $request)
    {
        $workspace = Workspace::with('user')->get();
        return $this->successResponse($workspace, 200);
    }


    public function user_list()
    {
        $users = User::all();
        return $this->successResponse($users, 200);
    }

    public function assignmentUserToWorkspace(Request $request)
    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $workspace_user = new Workspace_user();
        $workspace_user->user_id = $request->user_id_selected;
        $workspace_user->workspace_id = $request->workspace_id_selected;
        $workspace_user->owner = $request->owner;
        $is_admin = $decoded->is_admin;
        if (!$is_admin) {
            return $this->successResponse("you are not admin", 400);
        } else {
            $workspace_user->save();
            return $this->successResponse("success", 200);

        }

    }


}
