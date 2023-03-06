<?php
namespace App\Traits;
trait ApiResponse{
    protected function successResponse($data,$code){
        return response()->json([
            'status'=>'success',
            'message'=>'',
            'data'=>$data
        ],$code);

    }
    protected function errorResponse($message,$code){
        return response()->json([
            'status'=>'error',
            'message'=>$message,
            'data'=>''
        ],$code);
    }
}
