<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Techset extends Model
{
    use HasFactory;

    public static function nameFromId($id) {
        return Techset::select('name')->find($id);
    }    

    public static function allIdNames() {
        return Techset::select('id', 'name')->where('id','<>',null)->get();
    }

    public static function allNames() {
        $techsets = Techset::all();
        foreach($techsets as $techset) {
            $response[] = $techset['name'];
        }
        return $response;
    }

    
}
