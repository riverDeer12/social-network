@extends('layouts.master')

@section('title')My Profile @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header text-center"
                         style="background: url({{ Storage::url( $user->cover ) }}); background-size: cover;">
                        <img class="img-responsive profile-img" src="{{ Storage::url( $user->avatar ) }}" width="150px"
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
                <!-- Friend component -->
                <friend :profile_user_id="{{ $user->id }}"></friend>
            </div>

            <!-- Create new post form -->
            <div class="col-md-4">
                <form class="form-horizontal" action="{{ route('posts.store') }}" method="POST">
                    {{ csrf_field() }}

                    <fieldset>

                        <legend class="text-center">Wanna post something?</legend>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="title" type="text"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                       value="{{ old('title') }}" required autofocus placeholder="enter title here...">

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea id="description"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"
                                          value="{{ old('description') }}" required autofocus placeholder="enter description here..."></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="location" name="location" placeholder="enter location here..."
                                       class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <label class="control-label" for="image">Upload image</label>
                            <div class="col-md-12">
                                <input id="image" name="image" class="input-file" type="file">
                            </div>
                        </div>

                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                        <div class="form-group">
                            <div class="col-md-8 offset-2">
                                <button id="postButton" name="postButton" class="btn btn-success btn-block">Create new
                                    post !
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

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
@endsection