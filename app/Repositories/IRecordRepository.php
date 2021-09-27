<?php

namespace App\Repositories;

use App\Http\Requests\RecordRequest;
use App\Models\Record;

interface IRecordRepository
{
    public function getRecordById(int $id);

    public function createRecord($request);
}
