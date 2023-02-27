<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentUserRequest;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use App\Models\DepartmentUser;

class DepartmentUserController extends Controller
{
    public function store(DepartmentUserRequest $request)

    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $department_user = new DepartmentUser();
        $department_user->shift_id = $request->shift_id;
        $department_user->user_id  =$decoded->user_id;
        $department_user->department_id = $request->department_id;
        $department_user->enter_time  = $request->enter_time;
        $department_user->max_enter_time = $request->max_enter_time;
        $department_user->exit_time  = $request->exit_time;
        $department_user->owner  = $request->owner;
        $department_user->save();

        return response()->json(["success"], 200);
    }

    public function edit($id)
    {
        $department_user = DepartmentUser::findOrfail($id);
        return response()->json([$department_user], 200);
    }

    public function update(DepartmentUserRequest $request)
    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        DepartmentUser::where('id', $request->id)->first()
            ->update([

                'user_id' => $decoded->user_id,
                "shift_id" => $request->shift_id,

                "department_id" => $request->department_id,
                "enter_time" => $request->enter_time,
                "max_enter_time" => $request->max_enter_time,
                "exit_time" => $request->exit_time,
                "owner" => $request->owner,
            ]);

        return response()->json(["success"], 200);
    }
}
