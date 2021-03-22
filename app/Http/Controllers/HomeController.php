<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $records = Record::with('user')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $following = User::with('following')
            ->whereHas('followers', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->pluck('id');

        $feed = Record::with('user')
            ->whereHas('user', function ($query) use ($following) {
                $query->whereIn('id', $following);
            })
            ->orderByDesc('created_at')
            ->paginate(4);

        return view('home.index', [
            'records' => $records,
            'feed' => $feed
        ]);
    }
}
