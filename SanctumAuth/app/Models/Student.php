<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'students';
    public  $timestamps = false;
    protected $guarded = [];

    public static function logingHandling($request){

        $student = static::where('email', $request->email)->first();
        if(isset($student->id)){
            if(Hash::check( $request->password,$student->password)){
                // create a token
                $token = $student->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'status' => 1,
                    'message' => 'Student logged in!',
                    'access_token' => $token
                ]);
            } else{
                return response()->json([
                    'status' => 1,
                    'message' => 'Student password is not correct!'
                ],404);
            }
        }
        return response()->json([
            'Student not found'
        ],404);
    }


}
