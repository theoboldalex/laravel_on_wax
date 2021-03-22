<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $records = Record::with('user')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        // get only records by those you follow and paginate them.
        $feed = Record::with('user')
            ->orderByDesc('created_at')
            ->paginate(4);


        return view('home.index', [
            'records' => $records,
            'feed' => $feed
        ]);
    }
}
