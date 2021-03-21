<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $username = Str::before(Str::after($request->getRequestUri(), '/users/'), '/follow');
        $user = User::where('username', $username)
        ->with('records')
        ->first();

        $user->followers()->attach(auth()->id());

        return redirect()
            ->route('profile', $user->username)
            ->with(['user' => $user]);
    }

    public function unfollow(Request $request)
    {
        $username = Str::before(Str::after($request->getRequestUri(), '/users/'), '/follow');
        $user = User::where('username', $username)
            ->with('records')
            ->first();

        $user->followers()->detach(auth()->id());

        return view('users.profile', ['user' => $user]);
    }
}
