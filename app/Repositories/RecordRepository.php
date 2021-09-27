<?php

namespace App\Repositories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordRepository implements IRecordRepository
{

    public function getRecordById(int $id): Model|Builder
    {
        return Record::with([
            'likes',
            'comments' => function ($query) {
                $query->with('user');
            }
        ])
            ->where('id', $id)
            ->firstOrFail();
    }

    public function createRecord($request)
    {
        $path = Storage::disk('s3')->url('public/records/default-record.jpg');

        if ($request->file('image')) {
            $path = $request->file('image')->storePublicly('public/records', 's3');
        }

        // try catch?
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
    }
}
