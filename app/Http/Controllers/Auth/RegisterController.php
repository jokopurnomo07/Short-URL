<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required|exists:users,username',
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
