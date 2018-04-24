@extends('layouts.master')

@section('title')My Profile @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header text-center"
                         style="background: url({{ Storage::url( $user->cover ) }}); background-size: cover;">
                        <img class="img-responsive profile-img" src="{{ $user->avatar }}" width="150px"
                             height="150px">
                    </div>
                    <div class="card-body text-center">
                        <p>Name: {{ $user->name }}</p>
                        <p>Location:
                            @if($user->profile->location == NULL)
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Edit
                                        your
                                        location</a>
                                @else
                                    No info about location.
                                @endif
                            @else
                                {{ $user->profile->location }}
                            @endif
                        </p>
                        <p>Profession:
                            @if($user->profile->profession == NULL)
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Edit
                                        your
                                        profession</a>
                                @else
                                    No info about profession.
                                @endif
                            @else
                                {{ $user->profile->profession }}
                            @endif
                        </p>
                        <p>Age: {{ $user->dob->age }} years old</p>
                        <p>Gender:
                            @if($user->gender == 1)
                                Male
                            @else
                                Female
                            @endif
                        </p>
                        <span class="form-control text-center">
                            @if(Auth::user()->id == $user->id)
                                @if($user->profile->about == NULL)
                                    <a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Write something about yourself</a>
                                @else
                                    <span>{{ $user->profile->about }}</span>
                                @endif
                            @elseif($user->profile->about == NULL)
                                <span>No further description.</span>
                            @else
                                <span>{{ $user->profile->about }}</span>
                            @endif
                        </span>
                        @if(Auth::user()->id == $user->id)
                            <span class="float-right">
                                <a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Edit your details</a>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- Users relationship -->
                <friend :profile_user_id="{{ $user->id }}"></friend>
            </div>

            <!-- Create new post -->
            <create-post></create-post>

            <!-- Flash message -->
            <div class="col-md-3">
                <div class="pull-right">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $message)
                            @if(Session::has('alert-' . $message))

                                <p class="alert alert-{{ $message }}">{{ Session::get('alert-' . $message) }} <a
                                            href="#"
                                            class="close"
                                            data-dismiss="alert"
                                            aria-label="close">&times;</a>
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wall posts -->
    <wall :user_id="{{ $user->id }}"></wall>
@endsection