<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'record_id'
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
