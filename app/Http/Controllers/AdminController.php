<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // login
    public function loginAdmin()
    {
        if (auth()->check()) {
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postLoginAdmin(Request $request)
    {
        // $remember = $request->has('remember-me') ? true : false;
        // if (auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ], $remember));
        // return redirect()->to('home');

        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return view('login');
        }
        return redirect()->to('home');
    }
}
