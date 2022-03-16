<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

    public static function fileById($id) {        
        return File::find($id);
    }
}
