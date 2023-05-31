<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table ='chats';

    protected $fillable = [
        'room_id',
        'user_id',
        'text'
    ];


    public function ChatRoom(){
        return $this->belongsTo(ChatRoom::class, 'room');
    }
}
