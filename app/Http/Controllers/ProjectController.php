<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTechset;
use App\Models\Techset;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, $mensaje = '')
    {
        $projects = Project::all();
        foreach($projects as $project) {
            // $project['techsets'] = ProjectTechset::where('project_id',$project['id'])->get('techset_id');
            $project['techsets'] = $project->projectTechsetNames($project['id']);
            $project['files'] =  $project->projectFiles($project['id']);
            $response[] = $project;
        }
        return response()->json($response);
    }
}
