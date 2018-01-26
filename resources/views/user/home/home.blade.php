@extends('layouts.master')

@section('title', 'HOME')

@section('content')

    <div class="col-md-3">
        <div class="alert alert-info">
            <a class="nav-link" href="{{ route('profile', $user->profile->profile_url ? $user->profile->profile_url : $user->uid) }}">
                <img width="40px" class="rounded-circle" src="{{ url('/img/pic.jpg') }}">
                {{ $user->first_name }} {{ $user->last_name }}
            </a>
        </div>
    </div>

    <div class="col-md-6">

        @include('includes.postbox')
        @include('includes.statuses')

    </div>

    <div class="col-md-3">

    </div>

@endsection
