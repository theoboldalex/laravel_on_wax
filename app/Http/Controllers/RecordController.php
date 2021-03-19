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
        $record = Record::where('id', $id)->first();

        return view('records.detail', [
            'record' => $record
        ]);
    }

    public function store(Request $request)
    {
        // validate image filetype
        $this->validate($request, [
            'title' => 'required',
            'artist' => 'required',
        ]);

        $path = $request->file('image')->store('public/records');
        $record = Record::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'label' => $request->label,
            'catalog_number' => $request->catalog_number,
            'year' => $request->year,
            'diameter' => $request->diameter,
            'rpm' => $request->rpm,
            'image' => Str::after($path, 'public/records/'),
            'user_id' => auth()->id()
        ]);


        return redirect()->route('home');
    }
}
