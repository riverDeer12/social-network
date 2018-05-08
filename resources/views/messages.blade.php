@extends('layouts.master')

@section('title')Messages @endsection

@section('content')
    <div class="container-fluid spacing">
        <div class="row">
            <h3>Messenger</h3>
        </div>
        <div class="col-md-5">
            <message-log :messages="messages"></message-log>
            <create-message @messagesent="addMessage"></create-message>
        </div>
    </div>
@endsection