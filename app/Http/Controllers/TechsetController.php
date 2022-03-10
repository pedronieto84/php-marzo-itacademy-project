<?php

namespace App\Http\Controllers;

use App\Models\Techset;
use Illuminate\Http\Request;
class TechsetController extends Controller
{
    public function index(Request $request, $mensaje = '')
    {
        // Devuelve colección de id y names: return response()->json(Techset::allIdNames());
        return response()->json(Techset::allNames());
    }
}
