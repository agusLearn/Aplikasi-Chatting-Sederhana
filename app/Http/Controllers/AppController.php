<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function appChat()
    {
        $user_id = Auth::user()->id;

        $friends = DB::table('chat_rooms')
            ->select('chat_rooms.*', 'u.name AS user_name', 'u.email AS user_email', 'pi.description', 'pi.photo_profile','pi.path_photo_profile' ,DB::raw('coalesce(chats.text, "") as text'), DB::raw('coalesce(chats.created_at, chat_rooms.created_at) as time'))
            ->leftJoin(DB::raw('(SELECT MAX(chats.created_at) AS max_time, room_id
                     FROM chats
                     GROUP BY room_id) latest_chats'), function ($join) {
                $join->on('latest_chats.room_id', '=', 'chat_rooms.room');
            })
            ->leftJoin('chats', function ($join) {
                $join->on('chats.room_id', '=', 'chat_rooms.room')
                    ->on('chats.created_at', '=', 'latest_chats.max_time');
            })
            ->join('users as u', function ($join) use ($user_id) {
                $join->on('u.id', '=', 'chat_rooms.user_1')
                    ->orOn('u.id', '=', 'chat_rooms.user_2')
                    ->where('u.id', '!=', $user_id);
            })
            ->leftJoin('personal_information as pi', function ($join) {
                $join->on('pi.user_id', '=', 'u.id');
            })
            ->where(function ($query) use ($user_id) {
                $query->where('u.id', '!=', $user_id);
                $query->where('chat_rooms.user_1', $user_id)
                    ->orWhere('chat_rooms.user_2', $user_id);
            })  
            ->orderBy(DB::raw('coalesce(chats.created_at, chat_rooms.created_at)'), 'DESC')
            ->get();



        // return $friends;
        return view('appChat', ['friends' => $friends]);
    }
}
