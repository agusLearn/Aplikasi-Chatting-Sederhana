<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchFriendsController extends Controller
{
    public function find(Request $data)
    {
        $id_user = Auth::user()->id;

        $listFriends = User::with(['personalInfo' => function ($query) {
            $query->select('user_id', 'description', 'photo_profile');
        }])
            ->where('users.id', '!=', $id_user)
            ->where('users.name', 'LIKE', '%' . $data->name . '%')
            ->whereNotExists(function ($query) use ($id_user) {
                $query->select(DB::raw(1))
                    ->from('chat_rooms')
                    ->where(function ($subquery) use ($id_user) {
                        $subquery->where('chat_rooms.user_1', '=', $id_user)
                            ->orWhere('chat_rooms.user_2', '=', $id_user);
                    })
                    ->where(function ($subquery) use ($id_user) {
                        $subquery->whereRaw('chat_rooms.user_1 = users.id')
                            ->orWhereRaw('chat_rooms.user_2 = users.id');
                    })
                    ->where(function ($subquery) use ($id_user) {
                        $subquery->where('chat_rooms.user_1', '!=', $id_user)
                            ->orWhere('chat_rooms.user_2', '!=', $id_user);
                    });
            })
            ->get();


        $html_find_friends = view('findFriends', ['newFriends' => $listFriends])->render();

        return response()->json([
            'html' => $html_find_friends
        ]);
    }

    public function addFriends(Request $data)
    {
        $random = Str::random(6);
        $room_id = "room-" . $random . "-" . time();

        $save = new ChatRoom();
        $save->room = $room_id;
        $save->user_1 = Auth::user()->id;
        $save->user_2 = $data->user;

        $statusSave = $save->save();
        if ($statusSave == false) {
            return response()->json([
                'message' => 'failed to add friends, system maybe have trouble',
                'status' => 'failed'
            ]);
        }


        return response()->json(['status' => 'success']);
    }
}
