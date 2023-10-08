@extends('layout') 

@section('content')
    <div class="container">
        <h1>Send Email</h1>
        @include('email.partials.send-form') 
    </div>
@endsection
