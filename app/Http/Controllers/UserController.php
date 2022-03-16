<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

    public function create(Request $request, $user = null) {
        $json = $request->json()->all();
        $validator = Validator ::make([
                'name' => $json['name'],
                'email' => $json['email'],
                'password' => $json['password'],
                'verified' => $json['verified'],
                'admin' => $json['admin'],
                'typeOfInstitution' => $json['typeOfInstitution']
            ], [
                'name' => 'required|string',
                'email' => 'required|regex:/\S+@\S+.\S+/u',
                'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,8}$/',
                'verified' => 'required|boolean',
                'admin' => 'required|boolean',
                'typeOfInstitution' => 'required|string|in:Empresa Pública,ONG o empreses del 3er sector,Empresa Privada,Altres']
            );
        if ($validator->fails()) {
            return response(['error' => true, 'error-msg' => '400. Bad request, data no tiene formato especificado'], 400);
        }
        $validator = Validator ::make([
            'email' => $json['email'],
            ], [
            'email' => 'required|unique:users,email',]
        );
        if ($validator->fails()) {
            return response(['error' => true, 'error-msg' => '400. Bad request, el email ya existe'], 400);
        }

        if ($user === null) {
            $user = new User();
        }
        $user->name = $json['name'];
        $user->email = $json['email'];
        $user->password = Hash::make($json['password']);
        $user->email_verified_at = $json['verified'] ? new DateTime(now()) : null;
        $user->admin = $json['admin'] ? 1 : 0;
        $user->typeOfInstitution = $json['typeOfInstitution'];
        $user->save();
        return $user->id;
    }

    public function update($id, Request $request) {
        $user = User::find($id);
        if ($user !== null) {
            return $this->create($request, $user);
        }
        else {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest usuari no existeix'], 404);
        }
    }

    public function delete($id) {
        $deleted = User::destroy($id);
        if ($deleted) {
            return $id;
        }
        else {
            return response(['error' => true, 'error-msg' => '404. Resource not found, Aquest usuari no existeix'], 404);
        }
    }    

}
