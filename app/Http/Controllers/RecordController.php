<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordController extends Controller
{
    public function index()
    {
        return view('users.create');
    }

    public function show($id)
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'artist' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:30000'
        ]);

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
