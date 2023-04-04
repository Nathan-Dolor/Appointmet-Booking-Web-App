@extends('layout')
@section('content')
    <div class="container mb-3 vh-100">
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
        <h4 class="text-center">Register</h4>
        <form action="{{route('registration.post')}}" method="POST" class="ms-auto me-auto row g-3 mt-3" style="width: 400px; ">
            @csrf    
            <div class="mb-3 col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname">
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="tel_number">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="user_type" value="staff" onclick="checkMe()">
                <label class="form-check-label" for="gridCheck">
                    Register as Staff
                </label>
                </div>
            </div>
            <div class="mb-3" id="lunch_hour" style="display: none;">
                <label for="autoSizingSelect" class="mb-2">Lunch Hour</label>
                <select class="form-select" id="autoSizingSelect" name="lunch_hour">
                    <option value="" disabled selected hidden>--select--</option>
                    <option value="11am - 12pm">11am - 12pm</option>
                    <option value="12pm - 1pm">12pm - 1pm</option>
                </select>
            </div>
            <div class="d-grid text-center">
                <button type="submit" class="btn custom-button">Register</button>
            </div> <br>
            <div class="text-center">Already have an account? <a href="{{route('login')}}">Login</a></div>
        </form>
    </div>

    <script>
        function checkMe(){
            var checkBox = document.getElementById("gridCheck");
            var text = document.getElementById("lunch_hour");
            if(checkBox.checked==true){
                text.style.display="block";
            }else{
                text.style.display="none";
            }
        }
    </script>
@endsection