<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FollowController extends Controller
{
    public function follow()
    {
        $username = request()->route()->parameter('username');
        $user = User::where('username', $username)
        ->with('records')
        ->first();

        $user->followers()->attach(auth()->id());

        return redirect()
            ->route('profile', $user->username);
    }

    public function unfollow()
    {
        $username = request()->route()->parameter('username');
        $user = User::where('username', $username)
            ->with('records')
            ->first();

        $user->followers()->detach(auth()->id());

        return redirect()
            ->route('profile', $user->username);
    }
}
