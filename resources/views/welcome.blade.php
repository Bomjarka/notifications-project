@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">{{ __('Welcome') }}</div>
                    <div class="card-body">
                        <h5 class="card-title">This is Goals Notifications Project</h5>
                        <p class="card-text">This project allows you to create and manage your Goals</p>
                        <p>
                            @if ($user = auth()->user())
                                <a href="{{ route('web.user.goals.index', $user) }}" class="card-text">Here is all your Goals</a>
                            @else
                                <a href="{{ route('login') }}" class="card-text">Login</a> or <a class="card-text" href="{{ route('register') }}">Register</a> to start using this AWESOME service
                            @endif
                        </p>
                        <div>
                            <p class="card-text">Anyway you can just enjoy watching random kittens pictures below</p>
                            <img class="card-img" src="https://loremflickr.com/320/240/kitten/">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
