<?php

namespace App\Http\Controllers;

use App\Events\CreateShift;
use App\Http\Requests\ShiftRequest;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends ApiController
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
        event(new CreateShift());

    }

    public function show(Request $request)
    {
        $shift = Shift::with('workspace')->get();
        return $this->successResponse($shift,200);
    }

    public function edit($id)
    {
        $shift = Shift::findOrfail($id);
        return $this->successResponse($shift,200);

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
        return $this->successResponse("success",200);
    }

}
