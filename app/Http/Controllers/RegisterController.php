<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//MODEL
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        
        $credentials = $request->validate([
            // 'username' => 'required'
            'email' => 'required|email',
            'password' => 'required'
            // 'nama lengkap' => 'required'
            // 'alamat' => 'required'
            // 'hak akses' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        return back()->withInput()->with('failed','Login Failed!');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    
    
}