<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeSheetRequest;
use Illuminate\Http\Request;
use App\Models\TimeSheet;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TimeSheetController extends Controller
{
    public function store(TimeSheetRequest $request)
    {
        date_default_timezone_set('Asia/Tehran');
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
       $timeSheet = new TimeSheet();
        $timeSheet->user_id = $decoded->user_id;
        $timeSheet->shift_id = $request->shift_id;
        $timeSheet->department_id = $request->department_id;
        $timeSheet->date =  date("Y-m-d H:i:s",$request->date);
        $timeSheet->save();

        return response()->json(["success"], 200);
    }

    public function show(Request $request)
    {
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        $timeSheet = TimeSheet::with(['department','shift'])->where('user_id', $decoded->user_id)->get();
        return response()->json($timeSheet, 200);
    }

    public function edit($id)
    {
        $timeSheet = TimeSheet::find($id);
        return response()->json([$timeSheet], 200);
    }

    public function update(TimeSheetRequest $request)
    {
        date_default_timezone_set('Asia/Tehran');
        $key = 'token_key';
        $jwt = $request->token;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        TimeSheet::where('id', $request->id)->first()
            ->update([
                "user_id" => $decoded->user_id,
                "shift_id" => $request->shift_id,
                "department_id" => $request->department_id,
                "date" =>  date("Y-m-d H:i:s",$request->date),
            ]);

        return response()->json(["success"], 200);
    }
    public function destroy($id){
     TimeSheet::destroy($id);

        return response()->json("success", 200);


    }
}
