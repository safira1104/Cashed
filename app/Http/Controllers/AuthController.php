<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
     {
        //memvalidasi dan memproses data login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(auth()->attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            return redirect('/');

        }

        return back()-> withErrors([
            'email' => 'Email atau password tidak sesuai ',
        ])-> onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return redirect('login');
    }
}
