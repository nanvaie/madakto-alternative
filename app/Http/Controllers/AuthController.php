<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    public function signup(Request $request)
    {
        $request->validate([
            "full_name" => ["required", 'min:4', 'max:63'],
            "email" => ["required", "email:rfc"],
            "password" => ["required", 'min:8', 'max:32'],
            // same:password
            "user_name" => ["required", 'min:4', 'max:63'],
        ]);
        $user = new User;
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->password = Hash::make($request->password);
        $user->user_name = $request->user_name;
        if ($request->password == $request->confirm_password) {
            $user->save();
            return response()->json("success", 200);
        } else {

            return response()->json(['error' => "password and confirm password not equal"], 400);
        }
    }

    public function login(Request $request)

    {
        $request->validate([
            "email" => ["required", "email:rfc"],
            "password" => ["required"],

        ]);

        $key = 'token_key';

        $email = $request->email;
        $user = User::where('email', $email)->first();

//
        if ($user) {
            $payload = [
                'user_id' => $user->id,
                'user_name' => $user->user_name,
                'disabled' => $user->disabled,
                'is_admin' => $user->is_admin,

            ];

            $jwt = JWT::encode($payload, $key, 'HS256');
//
            if (Auth::attempt($request->only(['email', 'password']))) {
//
                return response()->json([

                    'message' => 'User Logged In Successfully',
                    'token' => $jwt,
                    'user' => $user->full_name
                ], 200);
            }
        }

        return response()->json("email or password is wrong", 400);


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
            return response()->json("password and confirm password not equal", 400);
        }

        return response()->json("email not found", 400);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();


        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
