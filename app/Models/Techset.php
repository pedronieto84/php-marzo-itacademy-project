<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Techset extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

    public static function allTechsets() {
        $techsets = Techset::all();
        foreach($techsets as $techset) {
            $response[] = $techset['name'];
        }
        return $response;
    }

    
}
