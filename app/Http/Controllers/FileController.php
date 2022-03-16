<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function get($id, $download = false) {
        $file = File::fileById($id);
        $filename = $file->filename;
        $filetype = $file->filetype;
        $route = $file->route;
        $path = $route . '/' . $filename;
        if ($download) {
            return Storage::download($path);
        }
        else {
            return Storage::response($path);
        }
    }
    public function download($id) {
        $this->get($id, true);
    }

}
