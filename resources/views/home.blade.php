@extends('layouts.master')

@section('title')NewsFeed @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Wanna post something?</button>
            </div>

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

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in ! Welcome to SocialNetwork !
                    </div>
                </div>
            </div>

            <div class="col-md-3 offset-1">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in ! Welcome to SocialNetwork !
                    </div>
                </div>
            </div>

        </div>
        <!-- Feed posts -->
        <feed></feed>
    </div>
@endsection
