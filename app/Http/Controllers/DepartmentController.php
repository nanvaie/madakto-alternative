<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends Controller
{
    public function store(DepartmentRequest $request)
    {
        $department = new Department();
        $department->name = $request->name;
        $department->user_id  = $request->user_id;
        $department->save();

        return response()->json(["success"], 200);
    }

    public function show(){

    }

    public function edit($id)
    {
        $department = Department::find($id);
        return response()->json([$department], 200);
    }

    public function update(DepartmentRequest $request)
    {
        Department::where('id', $request->id)->first()
            ->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
            ]);

        return response()->json(["success"], 200);
    }
}
