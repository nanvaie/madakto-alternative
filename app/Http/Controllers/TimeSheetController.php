<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSheet;

class TimeSheetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "shift_id" => ["required"],
            "department_id" => ["required"],
            "date" => ["required"],
        ]);
        date_default_timezone_set('Asia/Tehran');
       $timeSheet = new TimeSheet();
        $timeSheet->user_id = $request->user_id;
        $timeSheet->shift_id = $request->shift_id;
        $timeSheet->department_id = $request->department_id;
        $timeSheet->date =  date("Y-m-d H:i:s",$request->date);
        $timeSheet->save();

        return response()->json(["success"], 200);
    }

    public function show(Request $request)
    {

        $timeSheet = TimeSheet::with(['department','shift'])->where('user_id', $request->user_id)->get();
        return response()->json($timeSheet, 200);
    }

    public function edit($id)
    {
        $timeSheet = TimeSheet::find($id);
        return response()->json([$timeSheet], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "shift_id" => ["required"],
            "department_id" => ["required"],
            "date" => ["required"],
        ]);
        date_default_timezone_set('Asia/Tehran');
        TimeSheet::where('id', $request->id)->first()
            ->update([
                "user_id" => $request->user_id,
                "shift_id" => $request->shift_id,
                "department_id" => $request->department_id,
                "date" =>  date("Y-m-d H:i:s",$request->date),
            ]);

        return response()->json(["success"], 200);
    }
    public function destroy($id){
        $timeSheet = TimeSheet::find($id);
        $timeSheet->delete();
        return response()->json("success", 200);


    }
}
