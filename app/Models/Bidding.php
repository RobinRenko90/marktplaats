<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bidding extends Model
{
    protected $fillable = ['user_id', 'value'];

    protected $dates = ['created_at', 'updated_at'];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
