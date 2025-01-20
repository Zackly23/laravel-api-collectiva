<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class MessagePrivateChat extends Model
{
    use HasUuids;

    protected $guarded = ['message_private_chat_id'];

    protected $primaryKey = 'message_private_chat_id';

    protected $keyType = 'string';

    public $incrementing = false;


    public static function booted() {
        static::creating(function ($model) {
            $model->message_private_chat_id = Str::uuid();

        });
    }
    

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'user_id');

    }

    public function chats() {
        return $this->hasMany(Chat::class, 'chat_id', 'chat_id')->orderBy('created_at', 'desc');
    }
}
