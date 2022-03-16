<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $validator = Validator::make(['email' => $email], [
            'email' => 'required|regex:/\S+@\S+.\S+/u',
        ]);
        if ($validator->fails()) {
            return response()->json([ 'mensaje' => 'formato de email incorrecto' ]);
        }

        $validator = Validator::make(['password' => $password], [
               'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,8}$/'
        ]);
        if ($validator->fails()) {
            return response()->json([ 'mensaje' => 'formato de password incorrecto' ]);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            if ($user['email_verified_at'] === null) {
                Auth::logout();
                return response()->json([ 'mensaje' => 'la cuenta aún no ha sido activada, revise su correo' ]);
            }
            else {
                // $request->session()->regenerate();
                return response()->json([ Auth::user() ]);
            }
        }
 
        return response()->json([ 'mensaje' => 'no coincide con nuestros registros' ]);
    }
}
