<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchFriendsController extends Controller
{
    public function find(Request $data){
        $html_find_friends = view('findFriends')->render();

        return response()->json([
            'html' => $html_find_friends
        ]);
    }
}
