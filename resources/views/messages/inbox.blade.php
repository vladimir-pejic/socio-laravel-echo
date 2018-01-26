@extends('layouts.master')

@section('title', 'INBOX')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chatroom
                <span class="badge pull-right">@{{ usersInRoom.length }}</span>
            </div>
            <chat-log :messages="messages"></chat-log>
            <chat-box v-on:messagesent="addMessage"></chat-box>
        </div>
    </div>
@endsection