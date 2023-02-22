<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signup(RegisterRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->password = Hash::make($request->password);
        $user->user_name = $request->user_name;
        if ($request->password == $request->confirm_password) {
            $user->save();
            return response()->json("success", 200);
        } else {

            return response()->json("مشکلی رخ داده است لطفا چند ثانیه بعد امتحان کنید", 400);
        }
    }

    public function login(LoginRequest $request)

    {

        $key = 'token_key';
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            $payload = [
                'user_id' => $user->id,
                'user_name' => $user->user_name,
                'disabled' => $user->disabled,
                'is_admin' => $user->is_admin,

            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            if (Auth::attempt($request->only(['email', 'password']))) {

                return response()->json([

                    'message' => 'User Logged In Successfully',
                    'token' => $jwt,
                    'user' => $user->full_name,
                    'user_id'=>$user->id,
                ], 200);
            }
        }

        return response()->json("پست الکترونیک یا رمز عبور اشتباه است", 400);


    }


    public function forgetPass(Request $request)
    {

        $request->validate([
            "password" => ["required", 'min:8', 'max:32']
        ]);
        $email = $request->email;
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


        response()->json("شما از سیستم خارج شدید", 200);
    }
}
