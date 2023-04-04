@extends('layout')
@section('content')
    <div class="vh-100">
        <h4 class="text-center mt-3">Home</h4>
        @if(auth()->user()->user_type == "member")
        <div class="d-grid gap-2 col-3 mx-auto mt-3">
            <a class="btn btn-primary" href="{{ url(route('bookAppointment')) }}" role="button">Book Appointment</a>
            <a class="btn btn-primary" href="{{ url(route('viewMemberAppointments')) }}" role="button">View Appointments</a>
        </div>
        @endif

        @if(auth()->user()->user_type == "staff")
        <div class="d-grid gap-2 col-3 mx-auto mt-3">
            <a class="btn btn-primary" href="{{ url(route('viewStaffAppointments')) }}" role="button">View My Appointments</a>
            <a class="btn btn-primary" href="{{ url(route('viewAllAppointments')) }}" role="button">View All Appointments</a>
        </div>
        @endif
    </div>
@endsection