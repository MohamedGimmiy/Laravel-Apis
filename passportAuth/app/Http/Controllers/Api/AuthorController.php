<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\authorLoginRequest;
use App\Http\Requests\authorRegisterRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    // REGISTER METHOD - POST
    public function register(authorRegisterRequest $request)
    {
        Author::create([
            ...$request->except(['password', 'password_confirmation']),
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Author created successfully!'
        ]);
    }
    // LOGIN METHOD - POST
    public function login(authorLoginRequest $request)
    {
        if(!auth()->attempt($request->all())){
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials'
            ]);
        }
        $token = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'Author Logged in successfully',
            'access_token' => $token
        ]);
    }
    // PROFILE METHOD - GET
    public function profile()
    {
        $user_data = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'User data',
            'data' => $user_data
        ]);
    }
    // LOGOUT METHOD - POST
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Author logged out successfully'
        ]);

    }
}
