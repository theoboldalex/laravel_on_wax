<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Repositories\RecordRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RecordController extends Controller
{
    private RecordRepository $recordRepository;

    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    public function index(): Factory|View|Application
    {
        return view('users.create');
    }

    public function show($id): Factory|View|Application
    {
        $record = $this->recordRepository->getRecordById($id);

        return view('records.detail', [
            'record' => $record
        ]);
    }

    public function store(RecordRequest $request): RedirectResponse
    {
        $this->recordRepository->createRecord($request);

        return redirect()->route('home');
    }
}
