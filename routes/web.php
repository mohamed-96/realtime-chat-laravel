<?php

use App\Events\WebsocketDemoEvent;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    broadcast(new WebsocketDemoEvent('ccccccc'));

    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chats', [App\Http\Controllers\ChatController::class, 'index']);
// Route::get('/messages', [App\Http\Controllers\ChatController::class, 'fetchMessages']);

Route::get('/users', [App\Http\Controllers\ChatController::class, 'fetchUsers']);
Route::get('/messages/{sender}/{reciver}', [App\Http\Controllers\ChatController::class, 'fetchMessages']);
Route::post('/messages', [App\Http\Controllers\ChatController::class, 'sendMessage']);
