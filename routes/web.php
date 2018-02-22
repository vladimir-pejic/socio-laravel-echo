<?php

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

Route::get('/', function () {return view('welcome'); });

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('login', 'Auth\LoginController@loginUser')->name('login.user');

Route::group(['middleware' => ['auth']], function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('profile/{user_alias}', 'User\ProfileController@show')->name('profile');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('user/status/{target_id}', 'Statuses\UserStatusController@store')->name('user.status.store');
    Route::post('user/comment/{status_id}', 'Statuses\UserStatusCommentController@store')->name('user.status.comment.store');

    // Likes
    Route::get('user/status/like/{id}', 'LikeController@likeUserStatus')->name('user.status.like');
    Route::get('user/comment/like/{id}', 'LikeController@likeUserStatusComment')->name('user.comment.like');
    Route::get('likes/UserStatus/{id}', 'LikeController@likesUserStatus');
    Route::get('likes/UserStatusComment/{id}', 'LikeController@likesUserStatusComment');

    // Chat
    Route::get('chat', 'Messages\ChatMessagesController@index')->name('chat.index');
    Route::get('chat/all', 'Messages\ChatMessagesController@all');
    Route::post('chat/all', 'Messages\ChatMessagesController@store');

    // Private messages
    Route::get('messages/inbox', 'Messages\MessageInboxController@index')->name('messages.inbox');
    Route::get('messages/all', 'Messages\MessageController@all');
    Route::post('messages/all', 'Messages\MessageController@store');

});