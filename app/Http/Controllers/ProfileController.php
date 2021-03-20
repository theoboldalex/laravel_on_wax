<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('username', Str::after($request->getRequestUri(), '/users/'))->first();
        return view('users.profile', ['user' => $user]);
    }

    public function show($id)
    {
        return view('users.edit_profile');
    }
}
