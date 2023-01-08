<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Create API - POST
    public function createEmployee(Request $request)
    {
        //validation
        $validated = $request->validate([
            'name' => 'required|min:4|max:50',
            'email' => 'required|min:7|max:50|email|unique:employees',
            'phone_no' => 'required|min:8|max:20',
            'gender' =>'required',
            'age' => 'required'
        ]);
        //create data
        Employee::create($validated);
        //send response
        return response()->json([
            'status' => 1,
            'message' => 'Employee created successfully'
        ]);
    }
    // List API - GET
    public function listEmployees()
    {
    }

    // Single Detail API - GET
    public function getSingleEmployee($id)
    {
    }
    // Update API - PUT
    public function updateEmployee(Request $request, $id)
    {
    }
    // Delete API - DELETE
    public function deleteEmployee($id)
    {
    }
}
