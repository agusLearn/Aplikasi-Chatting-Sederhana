<?php

namespace App\Http\Controllers;

use App\Events\SendChat;
use App\Models\Chat;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChattRoomController extends Controller
{
    public function viewRoomChat(Request $data)
    {

        $explode = explode('/', $data->room);
        $room = $explode[0];
        $id_user_friend = $explode[1];

        $chat = Chat::where('room_id', $room)->get(); // get data chatting
        $info_user_friends = User::find($id_user_friend);
        $personalInfo = PersonalInformation::find($info_user_friends->id);

        $html_room_chat = view('chatRoom', ['chat' => $chat, 'user' => $info_user_friends, 'status_user' => $personalInfo, 'chat_room' => $room])->render();

        return response()->json(['html_chat_room' => $html_room_chat]);
    }

    public function sendChat(Request $chat)
    {

        $chatting = Chat::create([
            'room_id' => $chat->room,
            'user_id' => Auth::user()->id,
            'text' => $chat->text
        ]);

        if (!$chatting) {
            return response()->json(['status' => 'failed', 'message' => 'something wrong with system Chat']);
        }


        event(new SendChat($chatting->text, $chatting->created_at->diffForHumans(), $chat->room, $chatting->user_id));

        // // nanti disini menggunakan pusher live server
        return response()->json(['status' =>'success']);
    }
}
