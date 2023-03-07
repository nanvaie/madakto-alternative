<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->email = $request->get('email');
        $user->full_name = $request->get('full_name');
        $user->password = Hash::make($request->get('password'));
        $user->user_name = $request->get('user_name');
        $user->save();
        return $this->successResponse('success', 200);
    }

    public function login(LoginRequest $request)

    {
        $key = 'token_key';
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json("پست الکترونیک اشتباه است", 401);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json("رمز عبور اشتباه است", 401);
        }
        $payload = [
            'user_id' => $user->id,
            'user_name' => $user->user_name,
            'disabled' => $user->disabled,
            'is_admin' => $user->is_admin,

        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        $bearerToken = $user->createToken('MyAuthApp')->plainTextToken;
        return response()->json([

            'message' => 'User Logged In Successfully',
            'token' => $jwt,
            'user' => $user->full_name,
            'bearerToken' => $bearerToken,
        ], 200);
    }


    public function forgetPass(Request $request)
    {
        $request->validate([
            "password" => ["required", 'min:8', 'max:32']
        ]);
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($request->password == $request->confirm_password) {
                User::where('email', $email)->update(['password' => $user->password = Hash::make($request->password)]);
                return response()->json("successfully password change", 200);
            }
            return response()->json("رمز عبور با تایید رمز عبور مطابقت ندارد", 400);
        }

        return response()->json("پست الکترونیک اشتباه است", 400);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse("شما از سیستم خارج شدید", 200);

    }
}
