<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Project;
use App\Models\ProjectTechset;
use App\Models\Techset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request, $mensaje = '')
    {
        $projects = Project::all();
        foreach($projects as $project) {
            // $project['techsets'] = ProjectTechset::where('project_id',$project['id'])->get('techset_id');
            $project['techsets'] = $project->projectTechSet($project['id']);
            $project['files'] =  $project->projectFiles($project['id']);
            $response[] = $project;
        }
        // return response()->json($response);
        return $response;
    }

    public function show($id){
        $response = Project::projectById($id);
        if ($response === null) {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest projecte no existeix'], 404);
        }
        else {
            return response()->json($response);
            
        }
    }

    public function create(Request $request, $project = null)
    {
        $json = $request->json()->all();

        $validator = Validator::make([
            'title' => $json['title'],
            'publishedDate' => $json['publishedDate'],
            'deadline' => $json['deadline'],
            'shortExplanation' => $json['shortExplanation'],

            ], [
            'title' => 'required|string',
            'publishedDate' => 'required|dateformat:U',
            'deadline' => 'required|dateformat:U',
            'shortExplanation' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response(['error' => true, 'error-msg' => '400. Bad request, data no tiene formato especificado'], 400);
        }
        if ($project === null) {
            $project = new Project;
        }
        else {
            ProjectTechset::where('project_id', $project->id)->delete();
            File::where('project_id', $project->id)->delete();

        }

        $project->user_id = $json['user_id'];
        $project->title = $json['title'];
        $project->publishedDate = date('Y-m-d H:i:s', $json['publishedDate']);
        $project->deadline = date('Y-m-d H:i:s', $json['deadline']);
        $project->shortExplanation = $json['shortExplanation'];
        $project->state = $json['state'];
        $project->bid = $json['bid'];
        $project->save();
        foreach ($json['techSet'] as $techset) {
            $projectTechset = new ProjectTechset();
            $projectTechset->project_id = $project->id;
            $projectTechset->techset_name = $techset;
            $projectTechset->save();
        }
        foreach ($json['filesArray'] as $file) {
            $projectFile = new File();
            $projectFile->project_id = $project->id;
            $projectFile->filename = $file['filename'];
            $projectFile->filetype = $file['filetype'];
            $projectFile->route = $file['route'];
            $projectFile->save();
        }
        return $project->id;
    }

    public function update($id, Request $request){
        $project = Project::find($id);
        if ($project !== null) {
            return $this->create($request, $project);
        }
        else {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest projecte no existeix'], 404);
        }

    }

    public function delete($id){
        $deleted = Project::destroy($id);
        if ($deleted) {
            return $id;
        }
        else {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest projecte no existeix'], 404);
        }
    }
}
