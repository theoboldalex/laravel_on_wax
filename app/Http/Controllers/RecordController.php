<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'title' => 'required',
            'artist' => 'required',
        ]);

        $record = Record::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'label' => $request->label,
            'catalog_number' => $request->catalog_number,
            'year' => $request->year,
            'diameter' => $request->diameter,
            'rpm' => $request->rpm,
            'image' => $request->image
        ]);

        return redirect()->route('home');
    }
}
