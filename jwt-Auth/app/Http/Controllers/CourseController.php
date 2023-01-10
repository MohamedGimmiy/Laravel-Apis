<?php

namespace App\Http\Controllers;

use App\Http\Requests\courseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // COURSE ENROLLMENT API - POST
    public function courseEnrollment(courseRequest $request)
    {
        # code...
        Course::create([
            'user_id' => auth()->user()->id,
            ...$request->all()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'course enrolled successfully!'
        ], 200);
    }

    // Total Course Enrollment API - GET
    public function totalCourses()
    {
        return response()->json([
            'total courses enrolled' => auth()->user()->totalCoursesNumber(),
            'courses' => auth()->user()->courses
        ]);
    }

    public function deleteCourse($id)
    {
        try {
            $course  = Course::findOrFail($id)->delete();
            return response()->json([
                'message' => 'course deleted !',
                'status' => 1
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'course not found !',
                'status' => 0
            ]);
        }
    }
}
