@extends('layouts.master')

@section('title')Notifications @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notifications</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($notifications as $notification)
                                <li class="list-group-item">
                                    <a href="/profile/{{ $notification->data['username'] }}">
                                        {{ $notification->data['name']}}
                                    </a>
                                    {{ $notification->data['message'] }}
                                    <span class="float-right">{{ $notification->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
