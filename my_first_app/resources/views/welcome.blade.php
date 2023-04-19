@extends('layout')
@section('content')
    <div class="vh-100 d-flex align-items-center">
        <div class="d-grid gap-2 col-3 mx-auto align-items-center justify-content-center" >    
            <img src="{{ asset('favicon.png') }}" alt="BookIt Logo" width="25%" class="mx-auto">
            <h2 style="margin-bottom: 20px; text-align: center">Welcome to, <span style="color: #0d6efd;">Book</span><span style="color: #FF0000;">It</span>!</h2>
            <a class="btn btn-outline-primary" href="{{ url(route('login')) }}" role="button" style="border-width: 3px;"><strong>Login</strong></a>
            <a class="btn custom-button" href="{{ url(route('registration')) }}" role="button">Register</a>        
        </div>
    </div>
    
@endsection