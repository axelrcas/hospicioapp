<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function mostrarLoginForm() {

        return view('login');
    }

    public function login() {

        //  Validacion de campos y declaracion del array para las credenciales
        $credenciales = $this->validate(request(), [
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        if ( Auth::attempt($credenciales) ) {
            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors([ 'usuario' => trans('auth.failed') ])
            ->withInput(request(['usuario']));
    }

    public function logout() {

        Auth::logout();
        return redirect('/');
    }
}
