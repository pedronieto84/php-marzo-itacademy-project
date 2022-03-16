<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $timestamps = FALSE;


    public static function projectTechSet($id) {
        $techsets = null;
        $project_techsets = ProjectTechset::select('techset_name')->where('project_id',$id)->get();
        foreach($project_techsets as $project_techset) {
            $techsets[] = $project_techset['techset_name'];
        }
        return $techsets;
    }    

    public static function projectFiles($id) {
        $files = null;
        $project_files = File::select('id','filename','filetype')->where('project_id',$id)->get();
        foreach($project_files as $project_file) {
            $files[] = $project_file;
        }
        return $files;
    }

    public static function projectById($id) {
        $project = Project::find($id);
        if ($project !== null) {
            $project['filesArray'] = self::projectFiles($id);
            $project['techSet'] = self::projectTechSet($id);
        }
        return $project;    
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
