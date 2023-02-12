<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $key = 'token_key';

        if($request->has('token')) {
            $jwt = $request->token;
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            $is_admin = $decoded->is_admin;
            if (!$is_admin) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Unauthorized!'
                ], 401);
            } else {


                return $next($request);
            }
        }else{
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized!'
            ], 401);
        }



    }
}
