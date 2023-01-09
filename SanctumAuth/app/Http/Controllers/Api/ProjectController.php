<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\projectRequest;
use App\Models\Project;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    // CREATE PROJECT API
    public function createProject(projectRequest $request)
    {
        Project::create([
            ...$request->all(),
            'student_id' => auth()->user()->id
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'project created successfully!'
        ]);
    }

    // LIST PROJECT API
    public function listProject()
    {
        $projects = Project::where('student_id', auth()->user()->id)->get();
        return response()->json([
            'projects' => $projects,
            'status' => 1
        ]);
    }

    // SINGLE PROJECT API
    public function singleProject($id)
    {   // access only projects related to the student only
        $student_id = auth()->user()->id;
        try {
            $project = Project::where(['id' => $id, 'student_id' => $student_id])->get();
        } catch (Exception $e) {
            return response()->json([
                'Error project not found'
            ], 404);
        }
        return response()->json([
            'project' => $project,
            'status' => 1
        ]);
    }

    // DELETE PROJECT API
    public function deleteProject($id)
    {
        $student_id = auth()->user()->id;
        try{
            $project = Project::where(['id' => $id, 'student_id' => $student_id])->first();
            $project->delete();
        }
        catch(Exception $e){
            return response()->json([
                'status' => 1,
                'message'=> 'project not found'
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' =>'project deleted successfully'
        ]);
    }
}
