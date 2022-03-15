<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publishedDate' => 'datetime:U',
        'deadline' => 'datetime:U'
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    


    // protected $cast=['techsets'=>'array'];

}
