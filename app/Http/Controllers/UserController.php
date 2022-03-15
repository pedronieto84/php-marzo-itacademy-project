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

    public function show(User $user){
        return $user;
    }

    public function create(Request $request)
    {
        $request->validate([]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->verified = $request->verified;
        $user->projectsPublished = $request->projectsPublished;
        $user->admin = $request->admin;
        $user->typeOfInstitution = $request->typeOfInstitution;
        $user->save();
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->verified = $request->verified;
        $user->projectsPublished = $request->projectsPublished;
        $user->admin = $request->admin;
        $user->typeOfInstitution = $request->typeOfInstitution;
        $user->save();
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
        return $user;
    }
}
