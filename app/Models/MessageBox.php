<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Message;
use App\Models\User;

#[Table(key: 'uuid', keyType: 'string', incrementing: false)]
class MessageBox extends Model
{
    use HasUuids;

    protected $table="message_boxes";
    protected $fillable = ['seller_id', 'interested_id'];

    public $incrementing = false;

    public function seller(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    public function interested(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'interested_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'message_box_uuid', 'uuid')->orderBy('created_at');
    }
}
