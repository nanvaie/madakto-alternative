<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function store(ShiftRequest $request)
    {
        $shift = new Shift();
        $shift->title = $request->get('title');
        $shift->workspace_id = $request->get('workspace_id_selected');
        $shift->enter_time = $request->get('enter_time');
        $shift->max_enter_time = $request->get('max_enter_time');
        $shift->exit_time = $request->get('exit_time');
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
        $shift = Shift::findOrfail($id);
        return response()->json([$shift], 200);
    }

    public function update(ShiftRequest $request)
    {
        Shift::where('id', $request->id)->first()
            ->update([
                'title' => $request->get('title'),
                'workspace_id' =>$request->get('workspace_id_selected'),
                'enter_time' =>$request->get('enter_time'),
                'max_enter_time' =>$request->get('max_enter_time'),
                'exit_time' =>$request->get('exit_time'),
            ]);

        return response()->json(["success"], 200);
    }

}
