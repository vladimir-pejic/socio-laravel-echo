@extends('layouts.master')

@section('title', $profile->first_name)

@section('content')

        {{-- LEFT COLUMN--}}
        <div class="col-md-3">
            <img src="{{ url('/img/pic.jpg') }}" width="100%">
            {{ $profile->first_name . ' ' . $profile->last_name }}
        </div>

        {{-- MIDDLE COLUMN --}}
        <div class="col-md-6 container-fluid">

            @include('includes.messages')

            @include('includes.postbox')

            @include('includes.statuses')

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-md-3">
            <a href="#"><i class="fa fa-cog"> SETTINGS</i></a>
        </div>

@endsection
