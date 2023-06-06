<?php

use App\Events\SendChat;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChattRoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchFriendsController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// application route
Route::get('/', [AppController::class, 'appChat'])->name('appChat')->middleware('checkLogin');


// profile route
Route::get('profile', [ProfileController::class, 'profile'])->name('profile')->middleware('checkLogin');
Route::post('edit-profile', [ProfileController::class, 'saveEditProfile'])->name('saveEditProfile')->middleware('checkLogin');

// chat route
Route::post('chat-room', [ChattRoomController::class, 'viewRoomChat'])->name('chatRoom')->middleware('checkLogin');
Route::post('send-chat-room', [ChattRoomController::class, 'sendChat'])->name('sendChatRoom')->middleware('checkLogin');


// search route
Route::post('search-friends', [SearchFriendsController::class, 'find'])->name('searchFriends')->middleware('checkLogin');
Route::post('add-friends', [SearchFriendsController::class, 'addFriends'])->name('addFriends')->middleware('checkLogin');

// remove chat route
Route::post('remove-chat',[ChattRoomController::class, 'removeChat'])->name('removeChat');

// auth route
Route::get('logout', [LoginController::class, 'logout'])->name('logout-account');
Auth::routes();

// aplication route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
