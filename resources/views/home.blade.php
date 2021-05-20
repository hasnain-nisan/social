@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    User Info
                </div>
                <div class="card-body">
                    <div class="row">
                        <h3>Name: <span>{{ auth()->user()->name }}</span></h3>
                    </div>
                    <div class="row">
                        <h3>Username: <span>{{ auth()->user()->user_name }}</span></h3>
                    </div>
                    <div class="row">
                        <h3>Email: <span>{{ auth()->user()->email }}</span></h3>
                    </div>
                    <div class="row">
                        <h3>profile picture:</h3>
                        <img src="{{ asset('img/'. auth()->user()->profile_picture) }}" alt="" srcset="">
                    </div>
                    <div class="row">
                        <h3>Cover photo:</h3>
                        <img src="{{ asset('img/'. auth()->user()->cover_photo) }}" alt="" srcset="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
