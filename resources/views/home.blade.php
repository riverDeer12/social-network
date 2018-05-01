@extends('layouts.master')

@section('title')NewsFeed @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- Modal for new post-->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Post something great !</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <create-post></create-post>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3 offset-4 text-center">
                <button type="button" class="btn btn-success btn-lg spacing" data-toggle="modal" data-target="#myModal">
                    Do you want to post something?
                </button>
                <div class="card">
                    <div class="card-header text-center">Dashboard</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in ! Welcome to SocialNetwork !
                    </div>
                </div>
                <feed></feed>
            </div>

            <div class="col-md-3 offset-1">
                <div class="card">
                    <div class="card-header text-center">News</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        Some news about Social Network!
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
