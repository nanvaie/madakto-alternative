<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends ApiController
{
    public function store(DepartmentRequest $request)
    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $department = new Department();
        $department->name = $request->name;
        $department->user_id  = $decoded->user_id;
        $department->save();
        return $this->successResponse("success",201);
    }


    public function edit($id)
    {
        $department = Department::findOrfail($id);
        return $this->successResponse($department,200);
    }

    public function update(DepartmentRequest $request)
    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        Department::where('id', $request->id)->first()
            ->update([
                'name' => $request->name,
                'user_id' => $decoded->user_id,
            ]);
        return $this->successResponse("success",200);
    }
}
