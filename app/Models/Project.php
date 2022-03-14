<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function projectTechsetIds($id) {
        $techsets = null;
        $project_techsets = ProjectTechset::where('project_id',$id)->get('techset_id');
        foreach($project_techsets as $project_techset) {
            $techsets[] = Techset::find($project_techset['techset_id'])['id'];
        }
        return $techsets;
    }    

    public function projectTechsetNames($id) {
        $techsets = null;
        $project_techsets = ProjectTechset::where('project_id',$id)->get('techset_id');
        foreach($project_techsets as $project_techset) {
            $techsets[] = Techset::find($project_techset['techset_id'])['name'];
        }
        return $techsets;
    }    

    public function projectFiles($id) {
        $files = null;
        $project_files = File::select('id','filename','filetype','route')->where('project_id',$id)->get();
        foreach($project_files as $project_file) {
            $files[] = $project_file;
        }
        return $files;
    }

    // protected $cast=['techsets'=>'array'];

}
