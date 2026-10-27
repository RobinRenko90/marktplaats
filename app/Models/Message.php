<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['inbox_uuid', 'user_id', 'content'];

    public function inbox(): BelongsTo
    {
        return $this->belongsTo(Inbox::class, 'inbox_uuid', 'uuid');
    }
}
