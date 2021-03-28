<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * LikesController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function like()
    {
        $recordId = request()->route()->parameter('id');
        $record = Record::where('id', $recordId)->first();

        $record->likes()->attach(auth()->id());
        return back();
    }

    public function unlike()
    {
        $recordId = request()->route()->parameter('id');
        $record = Record::where('id', $recordId)->first();

        $record->likes()->detach(auth()->id());
        return back();
    }
}
