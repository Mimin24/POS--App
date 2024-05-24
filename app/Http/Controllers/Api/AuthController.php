<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {
        // validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Found '
            ], 404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credentials Doesnt Match Our Database'
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' =>$user
        ],200);
        // ALTERNATE
        // if(!auth()->attempt($request->only('email', 'password'))){
        //     return response()->json([
        //         'message' => 'Credentials Doesnt Match Our Database'
        //     ], 401);
        // }
    }
}
