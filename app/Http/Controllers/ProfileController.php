<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $reqUsername = request()->route()->parameter('username');

        $user = User::where('username', $reqUsername)
            ->with(['followers', 'records' => function($query) {
                $query->with('likes');
            }])
            ->firstOrFail();

        if ($user->followers->count()) {
            foreach ($user->followers as $follower) {
                $isFollowing = $follower->id === auth()->id();
            }
        } else {
            $isFollowing = false;
        }

        return view('users.profile', [
            'user' => $user,
            'isFollowing' => $isFollowing
        ]);
    }

    public function show($id)
    {
        $reqUsername = request()->route()->parameter('username');

        if ($reqUsername !== auth()->user()->username) {
            return back();
        }

        return view('users.edit_profile');
    }

    public function store(Request $request)
    {
        $path = $request->file('avatar')->store('public/avatar');

        $user = User::where('id', auth()->id())
            ->update(['avatar' => Str::after($path, 'public/avatar/')]);

        return redirect()->route('profile', $request->route()->username);
    }
}
