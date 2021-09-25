<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Models\Record;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('users.create');
    }

    public function show($id): Factory|View|Application
    {
        $record = Record::with([
            'likes',
            'comments' => function ($query) {
                $query->with('user');
            }
        ])
            ->where('id', $id)
            ->firstOrFail();

        return view('records.detail', [
            'record' => $record
        ]);
    }

    public function store(RecordRequest $request): RedirectResponse
    {
        $path = Storage::disk('s3')->url('public/records/default-record.jpg');

        if ($request->file('image')) {
            $path = $request->file('image')->storePublicly('public/records', 's3');
        }

        auth()->user()->records()->create([
            'title' => $request->title,
            'artist' => $request->artist,
            'label' => $request->label,
            'catalog_number' => $request->catalog_number,
            'year' => $request->year,
            'diameter' => $request->diameter,
            'rpm' => $request->rpm,
            'image' => Str::after($path, 'public/records/')
        ]);

        return redirect()->route('home');
    }
}
