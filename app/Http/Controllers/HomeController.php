<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    private HomeRepository $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index(): Factory|View|Application
    {
        $records = $this->homeRepository->getLatestRecords();
        $feed = $this->homeRepository->getUserFeed(auth()->id());

        return view('home.index', [
            'records' => $records,
            'feed' => $feed
        ]);
    }
}
