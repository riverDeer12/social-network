@extends('layouts.master')

@section('title')Messages @endsection

@section('content')
    <div class="container-fluid spacing">
        <div class="row">
            <h3>Messenger</h3>
        </div>
        <div class="col-md-10">
            <messenger :user_id="{{ Auth::user()->id}}"></messenger>
        </div>
    </div>
@endsection