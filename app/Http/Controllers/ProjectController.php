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
        // return response()->json($response);
        return $response;
    }

    public function show(Project $project){
        $project['techsets'] = $project->projectTechsetNames($project['id']);
        $project['files'] =  $project->projectFiles($project['id']);
        return $project;
        // return response()->json($project);
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required|string',
            'publishedDate' => 'required|date',
            'deadline' => 'required|date',
            'shortExplanation' => 'string|nullable'
        ]);
        $project = new Project;
        $project->user_id = $request->user_id;
        $project->title = $request->title;
        $project->publishedDate = $request->publishedDate;
        $project->deadline = $request->deadline;
        // techsets i files s'han de rebre també pel request? Com?
        // $project['techsets'] = $request->projectTechsetNames($request);
        // $project->techsets = $request->techsets;
        $project['techsets'] = $request['techsets'];
        // $project->files = $request->files;
        $project->shortExplanation = $request->shortExplanation;
        $project->state = $request->state;
        $project->bid = $request->bid;
        $project->save();
        return $project;
        // return response()->json($project);
    }

    public function update(Request $request, Project $project){
        // dd($project);
        // dd($request);
        $request->validate([
            'title' => 'required|string',
            'publishedDate' => 'required|date',
            'deadline' => 'required|date',
            'shortExplanation' => 'string|nullable'
        ]);
        $project->user_id = $request->user_id;
        $project->title = $request->title;
        $project->publishedDate = $request->publishedDate;
        $project->deadline = $request->deadline;
        $project->shortExplanation = $request->shortExplanation;
        $project->state = $request->state;
        $project->bid = $request->bid;
        $project->save();
        return $project;
        // return response()->json($project);
    }

    public function delete(Project $project){
        $project->delete();
        return $project;
    }
}
