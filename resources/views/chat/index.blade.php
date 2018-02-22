@extends('layouts.master')

@section('title', 'INBOX')

@section('content')
    <div class="col-md-12 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chatroom
                <span class="badge pull-right">Users: @{{ usersInRoom.length }}</span>
            </div>
            <chat-box v-on:messagesent="addMessage"></chat-box>
            <chat-log :messages="messages"></chat-log>
        </div>
    </div>
@endsection