<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $records = Record::with(['user', 'likes'])
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $following = User::with('following')
            ->whereRelation('followers', 'user_id', auth()->id())
            ->pluck('id');

        $feed = Record::with(['user', 'likes'])
            ->whereHas('user', function ($query) use ($following) {
                $query->whereIn('id', $following);
            })
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('home.index', [
            'records' => $records,
            'feed' => $feed
        ]);
    }
}
