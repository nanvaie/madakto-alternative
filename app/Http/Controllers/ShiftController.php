<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "title" => ["required", 'min:2', 'max:63'],
            "enter_time" => ["required"],
            "max_enter_time" => ["required"],
            "exit_time" => ["required"],
        ]);
        $shift = new Shift();
        $shift->title = $request->title;
        $shift->workspace_id = $request->workspace_id_selected;
        $shift->enter_time = $request->enter_time;
        $shift->max_enter_time = $request->max_enter_time;
        $shift->exit_time = $request->exit_time;
        $shift->save();

        return response()->json(["success"], 200);
    }

    public function show(Request $request)
    {
        $shift = Shift::with('workspace')->get();
        return response()->json($shift, 200);
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        return response()->json([$shift], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            "title" => ["required", 'min:2', 'max:63'],
            "enter_time" => ["required"],
            "max_enter_time" => ["required"],
            "exit_time" => ["required"],
        ]);

        Shift::where('id', $request->id)->first()
            ->update([
                'title' => $request->title,
                'workspace_id' => $request->workspace_id_selected,
                'enter_time' => $request->enter_time,
                'max_enter_time' => $request->max_enter_time,
                'exit_time' => $request->exit_time,
            ]);

        return response()->json(["success"], 200);
    }

}
