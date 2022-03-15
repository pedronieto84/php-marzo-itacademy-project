<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, $mensaje = '')
    {
        return response()->json(User::allUsers());
    }

    public function show($id){
        $response = User::userById($id);
        if ($response === null) {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest usuari no existeix'], 404);
        }
        else {
            return response()->json($response);
        }
    }

}
