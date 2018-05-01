@extends('layouts.master')

@section('title')Friends @endsection

@section('content')
    <div class="container-fluid spacing">
        <div class="row">
            <div class="card col-md-5 offset-3" style="padding: 20px;">
                <div class="card-header text-center">List of all users friends</div>
                @foreach($friends as $friend)
                    <a class="img-thumbnail spacing friend-row"
                       href="{{ route('profile', ['username' => $friend->username ]) }}">
                        <img src="{{ $friend->avatar }}" alt="" width="40px" height="40px"> {{ $friend->name }}
                        <span class="float-right">Time since they are friends</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection