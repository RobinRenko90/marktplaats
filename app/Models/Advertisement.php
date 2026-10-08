<?php

namespace App\Models;

use App\Models\Bidding;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'price', 'paid', 'user_id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function biddings():BelongsToMany {
        return $this->belongsToMany(Bidding::class, 'advertisement_biddings', 'advertisement_id', 'bidding_id');
    }

    public function categories():BelongsToMany {
        return $this->belongsToMany(category::class, 'advertisement_categories', 'advertisement_id', 'category_id');
    }
}
