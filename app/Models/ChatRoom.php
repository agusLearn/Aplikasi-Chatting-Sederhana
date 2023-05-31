<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $table = 'chat_rooms';

    protected $fillable = [
        'room',
        'user_1',
        'user_2',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function chat(){
        return $this->hasMany(Chat::class);
    }
}
