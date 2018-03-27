@extends('layouts.master')

@section('title')Profile Details @endsection

@section('content')
    <div class="container-fluid">
        <div class="col-md-4 offset-md-4">
            <div class="card card-default">
                <div class="card-header text-center">
                    <span class="pull-left">Edit your profile</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update', ['username' => Auth::user()->username])  }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="cover" class="col-md-4 col-form-label text-md-right">Cover image</label>

                            <div class="col-md-6">
                                <input id="cover" type="file" class="form-control" name="cover">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar image</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" name="avatar">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender" id="gender">
                                    @if(Auth::user()->gender == 1)
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    @else
                                        <option value="0">Female</option>
                                        <option value="1">Male</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-4 col-form-label text-md-right">Something about me</label>

                            <div class="col-md-6">
                                <textarea id="about" type="text" class="form-control" name="about"
                                          >{{ $user->profile->about }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right">Profession</label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control" name="profession"
                                       value="{{ $user->profile->profession }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location"
                                       value="{{ $user->profile->location }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-3">
                                <input class="btn btn-primary btn-block" type="submit" value="Update details" name="submit">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection