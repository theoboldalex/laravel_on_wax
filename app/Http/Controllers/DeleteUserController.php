<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function destroy(Request $request)
    {
        $user = User::where('username', $request->username)->firstOrFail();

        auth()->logout();

        $user->delete();

        return redirect()->route('home');
    }
}
