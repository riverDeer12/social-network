@extends('layouts.master')

@section('title')Friends @endsection

@section('content')
    <div class="container-fluid spacing">
        <div class="row">
            <div class="card col-md-5 offset-3" style="padding: 20px;">
                <div class="card-header text-center">List of all friends</div>
                @foreach($friends as $friend)
                    <a class="img-thumbnail spacing friend-row"
                       href="{{ route('profile', ['username' => $friend->username ]) }}">
                        <img src="{{ $friend->avatar }}" alt="" width="40px" height="40px"> {{ $friend->name }}
                        @foreach($friendships as $friendship)
                            <span class="float-right">
                                @if($friendship->requested_user == $friend->id || $friendship->requester == $friend->id )
                                    Friends since: {{ $friendship->created_at->diffForHumans() }}
                                @endif
                            </span>
                        @endforeach
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

