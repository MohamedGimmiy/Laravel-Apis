<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiController extends Controller
{
    // Create API - POST
    // URL: http://127.0.0.1:8000/api/create-employee
    public function createEmployee(EmployeeRequest $request)
    {
        //create data
        Employee::create($request->validated());
        //send response
        return response()->json([
            'status' => 1,
            'message' => 'Employee created successfully'
        ]);

    }
    // List API - GET
    // URL: http://127.0.0.1:8000/api/list-employees
    public function listEmployees()
    {
        return response()->json([
            'status' => 1,
            'employees' => Employee::all()
        ]);
    }

    // Single Detail API - GET
    // URL: http://127.0.0.1:8000/api/single-employee/1
    public function getSingleEmployee($id)
    {
        try{
            $employee = Employee::findOrFail($id);
        }
        catch(Exception $e){
            return response()->json([
                'Employee not found'
            ], 404);
        }

         return response()->json([
            'employee' => $employee
         ], 200);
    }

    // Update API - PUT
    // URL: http://127.0.0.1:8000/api/update-employee/11
    public function updateEmployee(EmployeeRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->update($request->all());
            return response()->json([
                'Employee updated successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'Error occured Failed to update Employee Not Found'
            ],404);
        }
    }
    // Delete API - DELETE
    // URL: http://127.0.0.1:8000/api/delete-employee/2
    public function deleteEmployee($id)
    {
        try {
            Employee::findOrFail($id)->delete();
            return response()->json([
                'Employee deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'Error Occured Failed to delete Employee Not Found'
            ],404);
        }
    }
}
