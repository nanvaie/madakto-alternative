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
            "time" => ["required"],
        ]);
       $timeSheet = new TimeSheet();
        $timeSheet->user_id = $request->user_id;
        $timeSheet->shift_id = $request->shift_id;
        $timeSheet->department_id = $request->department_id;
        $timeSheet->date = $request->date;
        $timeSheet->time = $request->time;
        $timeSheet->save();

        return response()->json(["success"], 200);
    }

    public function show(Request $request)
    {

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
            "time" => ["required"],
        ]);

        TimeSheet::where('id', $request->id)->first()
            ->update([
                "user_id" => $request->user_id,
                "shift_id" => $request->shift_id,
                "department_id" => $request->department_id,
                "date" => $request->date,
                "time" => $request->time,
            ]);

        return response()->json(["success"], 200);
    }
}
