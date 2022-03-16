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
    public function index(Request $request, $mensaje = '') {
        $projects = Project::all();
        foreach($projects as $project) {
            $project['techsets'] = $project->projectTechSet($project['id']);
            $project['filesArray'] =  $project->projectFiles($project['id']);
            $response[] = $project;
        }
        return $response;
    }

    public function show($id) {
        $response = Project::projectById($id);
        if ($response === null) {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest projecte no existeix'], 404);
        }
        else {
            return response()->json($response);
        }
    }

    public function create(Request $request, $project = null) {
        $json = json_decode($request['request']);
        $validator = Validator::make([
            'title' => $json->title,
            'publishedDate' => $json->publishedDate ?? null,
            'deadline' => $json->deadline ?? null,
            'shortExplanation' => $json->shortExplanation ?? null,
            'state' => $json->state ?? null,
            ], [
            'title' => 'required|string',
            'publishedDate' => 'nullable|dateformat:U',
            'deadline' => 'nullable|dateformat:U',
            'shortExplanation' => 'nullable|string',
            'state' => 'string|nullable|in:accepted,published,refused,doing,finished]'
        ]);
        if ($validator->fails()) {
            return response(['error' => true, 'error-msg' => '400. Bad request, data no tiene formato especificado'], 400);
        }
        $validatedData = $request->validate([
            'filesArray.*' => 'mimes:png,jpg,jpeg,pdf'
            ]);
        
        if ($project === null) {
            $project = new Project;
        }
        else {
            ProjectTechset::where('project_id', $project->id)->delete();
            File::where('project_id', $project->id)->delete();
        }

        $project->user_id = $json->user_id;
        $project->title = $json->title;
        $project->publishedDate = isset($json->publishedDate) ? date('Y-m-d H:i:s', $json->publishedDate) : null;
        $project->deadline = isset($json->deadline) ? date('Y-m-d H:i:s', $json->deadline) : null;
        $project->shortExplanation = isset($json->shortExplanation) ? $json->shortExplanation : null;
        $project->state = isset($json->state) ? $json->state : null;
        $project->bid = isset($json->bid) ? $json->bid : null;
        $project->save();
        if (isset($json->techSet)) { 
            foreach ($json->techSet as $techset) {
                $projectTechset = new ProjectTechset();
                $projectTechset->project_id = $project->id;
                $projectTechset->techset_name = $techset;
                $projectTechset->save();
            }
        }
        
        if ($request->hasfile('filesArray')) {
            foreach ($request->file('filesArray') as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName();
                $route = 'public/files/' . time();
                $file->storeAs($route, $name);
                $projectFile = new File();
                $projectFile->project_id = $project->id;
                $projectFile->filename = $name;
                $projectFile->filetype = $extension;
                $projectFile->route = $route;
                $projectFile->save();
            }
        }   
        return $project->id;
    }

    public function update($id, Request $request) {
        $project = Project::find($id);
        if ($project !== null) {
            return $this->create($request, $project);
        }
        else {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest projecte no existeix'], 404);
        }
    }

    public function delete($id) {
        $deleted = Project::destroy($id);
        if ($deleted) {
            return $id;
        }
        else {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest projecte no existeix'], 404);
        }
    }
}
