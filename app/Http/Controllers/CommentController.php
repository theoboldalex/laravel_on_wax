<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $recordId = $request->route()->parameter('id');

        $comment = Comment::create([
           'body' => $request->comment,
           'user_id' => auth()->id(),
           'record_id' => $recordId
        ]);

        return redirect()->route('record_detail', $recordId);
    }
}
