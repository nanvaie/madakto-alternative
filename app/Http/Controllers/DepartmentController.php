<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", 'min:2', 'max:63'],
            "user_id" => ["required"],

        ]);
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

    public function update(Request $request)
    {
        $request->validate([
            "name" => ["required", 'min:2', 'max:63'],
            "user_id" => ["required"],

        ]);

        Department::where('id', $request->id)->first()
            ->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
            ]);

        return response()->json(["success"], 200);
    }
}
