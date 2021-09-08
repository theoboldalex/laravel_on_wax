<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users|min:4',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (!auth()->attempt($request->only('email', 'password')))
        {
            return back();
        }

        return redirect()->route('home');
    }
}
