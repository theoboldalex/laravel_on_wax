<?php

namespace App\Repositories;

use App\Models\Record;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class HomeRepository implements IHomeRepository
{

    public function getLatestRecords(): Collection|array
    {
        return Record::with(['user', 'likes'])
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
    }

    public function getUserFeed($id): LengthAwarePaginator
    {
        $following = User::with('following')
            ->whereRelation('followers', 'user_id', $id)
            ->pluck('id');

        return Record::with(['user', 'likes'])
            ->whereHas('user', function ($query) use ($following) {
                $query->whereIn('id', $following);
            })
            ->orderByDesc('created_at')
            ->paginate(20);
    }
}
