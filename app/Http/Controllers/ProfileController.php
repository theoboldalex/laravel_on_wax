<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(): Factory|View|Application
    {
        $reqUsername = request()->route()->parameter('username');

        $user = User::where('username', $reqUsername)
            ->with([
                'followers', 'records' => function ($query) {
                    $query->with('likes');
                }
            ])
            ->firstOrFail();

        return view('users.profile', [
            'user' => $user,
            'isFollowing' => $user->followers->contains('id', auth()->id())
        ]);
    }

    public function show(): View|Factory|Application|RedirectResponse
    {
        $reqUsername = request()->route()->parameter('username');

        if ($reqUsername !== auth()->user()->username) {
            return back();
        }

        return view('users.edit_profile');
    }

    public function store(ProfileImageRequest $request): RedirectResponse
    {
        $path = $request->file('avatar')->storePublicly('public/avatar', 's3');

        User::where('id', auth()->id())
            ->update(['avatar' => Str::after($path, 'public/avatar/')]);

        return redirect()->route('profile', $request->route()->username);
    }
}

