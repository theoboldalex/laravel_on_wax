<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('username', Str::after($request->getRequestUri(), '/users/'))
            ->with(['records', 'followers'])
            ->first();

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
}
