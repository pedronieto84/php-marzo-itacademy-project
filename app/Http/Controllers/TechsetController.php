<?php

namespace App\Http\Controllers;

use App\Models\Techset;
use Illuminate\Http\Request;
class TechsetController extends Controller
{
    public function index(Request $request, $mensaje = '')
    {
        return response()->json(Techset::allTechsets());
    }
}
