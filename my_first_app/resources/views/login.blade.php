@extends('layout')
@section('content')
    <div class="container vh-100">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>  
        <h4 class="text-center" >Login</h4>
        <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 400px">
            @csrf    
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="d-grid text-center">
                <button type="submit" class="btn custom-button">Login</button> 
            </div>
            <div class="mt-3 text-center">Don't have an account? <a href="{{route('registration')}}">Register</a></div>
        </form>
        
    </div>
@endsection