<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChattRoomController;
use App\Http\Controllers\SearchFriendsController;
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
Route::get('chat-room', [ChattRoomController::class, 'viewRoomChat'])->name('chatRoom');

Route::post('search-friends', [SearchFriendsController::class, 'find'])->name('searchFriends');


// auth route
Route::get('login-view', [LoginController::class, 'login_view'])->name('login-view');
Auth::routes();

// aplication route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
