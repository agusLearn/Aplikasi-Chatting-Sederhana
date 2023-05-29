<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChattRoomController extends Controller
{
    public function viewRoomChat(){
        $html_room_chat = view('chatRoom')->render();

        return response()->json(['html_chat_room' => $html_room_chat]);
    }
}
