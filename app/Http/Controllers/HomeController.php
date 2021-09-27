<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;

class HomeController extends Controller
{
    private HomeRepository $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        $records = $this->homeRepository->getLatestRecords();
        $feed = $this->homeRepository->getUserFeed(auth()->id());

        return view('home.index', [
            'records' => $records,
            'feed' => $feed
        ]);
    }
}
