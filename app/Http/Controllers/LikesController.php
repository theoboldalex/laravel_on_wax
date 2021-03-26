<?php

namespace App\Http\Controllers;

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

    }

    public function unlike()
    {

    }
}
