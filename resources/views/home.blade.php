@extends('layouts.master')

@section('title')NewsFeed @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Create new post form -->
            <create-post></create-post>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in ! Welcome to SocialNetwork !
                    </div>
                </div>
            </div>
            <!-- Feed posts -->
            <feed></feed>

        </div>
    </div>
@endsection
