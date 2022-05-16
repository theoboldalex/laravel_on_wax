<?php

namespace App\Http\Controllers;

use App\Events\UserFollowed;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FollowController extends Controller
{
    public function follow(): RedirectResponse
    {
        $username = request()->route()->parameter('username');

        $user = User::where('username', $username)
            ->with('records')
            ->firstOrFail();

        UserFollowed::dispatch($user, auth()->user());

        $user->followers()->attach(auth()->id());

        return redirect()
            ->route('profile', $user->username);
    }

    public function unfollow(): RedirectResponse
    {
        $username = request()->route()->parameter('username');

        $user = User::where('username', $username)
            ->with('records')
            ->first();

        $user->followers()->detach(auth()->id());

        return redirect()
            ->route('profile', $user->username);
    }

    public function following(): Factory|View|Application
    {
        $username = request()->route()->parameter('username');

        $user = User::where('username', $username)
            ->with('following')
            ->first();

        return view('users.following', [
            'user' => $user
        ]);
    }

    public function followers(): Factory|View|Application
    {
        $username = request()->route()->parameter('username');

        $user = User::where('username', $username)
            ->with('followers')
            ->first();

        return view('users.followers', [
            'user' => $user,
        ]);
    }
}
