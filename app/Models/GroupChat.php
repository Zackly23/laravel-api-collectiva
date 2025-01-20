<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    protected $primaryKey = 'group_chat_id';

    protected $keyType = 'string';

    public $incrementing = false;

    public static function booted() {
        static::creating(function ($model) {
            $model->group_chat_id = Str::uuid();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_group_chats', 'group_chat_id', 'user_id');
    }

    public function messageGroupChat() {
        return $this->hasMany(MessageGroupChat::class, 'group_chat_id', 'group_chat_id');
    }
}
