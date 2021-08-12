<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function destroy(Request $request)
    {
        try {
            $this->delete_user($request);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
        return redirect()->route('home');
    }

    /**
     * @param Request $request
     */
    private function delete_user(Request $request): void
    {
        $user = User::where('username', $request->username)->firstOrFail();

        auth()->logout();

        $user->delete();
    }
}
