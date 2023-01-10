<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\userLoginRequest;

class UserController extends Controller
{

    // USER REGISTER API - POST
    public function register(userRequest $request)
    {
        User::create([
            ...$request->except(['password', 'password_confirmation']),
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'User registered successfully!'
        ],201);
    }
    // USER LOGIN API - POST
    public function login(userLoginRequest $request)
    {
        if(!$token = auth()->attempt(['email' => $request->email , 'password' => $request->password])){
            return response()->json([
                'status' => 0,
                'message' => 'Invalid credentials'
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'Logged in successfully',
            'access_token' => $token
        ]);
    }
    // USER PROFILE API - GET
    public function profile()
    {
        return response()->json([
            'status' => 1,
            'message'=> 'user profile data',
            'user' => auth()->user()]
            , 200);
    }
    // USER LOGOUT API - GET
    public function logout()
    {
            auth()->logout();
            return response()->json([
                'status' => 1,
                'message' => 'user logged out!'
            ]);
    }

}
