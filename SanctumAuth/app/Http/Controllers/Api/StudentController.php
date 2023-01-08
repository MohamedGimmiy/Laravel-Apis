<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // REGISTER API
    public function register(StudentRequest $request)
    {

        Student::create([
            ...$request->except(['password', 'password_confirmation']),
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'Student created successfully!'
        ]);
    }
    // LOGIN API
    public function login(StudentLoginRequest $request)
    {

        return  Student::logingHandling($request);
    }
    //PROFILE API
    public function profile()
    {
        # code...
    }
    // LOGOUT API
    public function logout()
    {
        # code...
    }
}
