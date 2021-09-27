<?php

namespace App\Repositories;

interface IHomeRepository
{
    public function getLatestRecords();

    public function getUserFeed($id);
}
