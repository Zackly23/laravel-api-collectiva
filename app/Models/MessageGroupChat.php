<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MessageGroupChat extends Model
{

    use HasUuids;
    protected $primaryKey = 'message_group_chat_id';

    protected $keyType = 'string';

    public $incrementing = false;

    // public function groupChats() {
    //     return $this->hasMany(GroupChat::class, 'group_chat_id', 'group_chat_id');
    // }

    public function chats() {
        return $this->hasMany(Chat::class, 'chat_id', 'chat_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'user_id');
    }

    public function groupChats()
    {
        return $this->belongsToMany(GroupChat::class, 'users_group_chats', 'group_chat_id', 'user_id');
    }

    
}
