@extends('layout')
@section('content')

<div class="mt-3 vh-100">
    <div class="row w-50 mx-auto">
        <?php $num_of_appointments = 0?>
        @foreach($appointments as $appointment)
            @if(auth()->user()->email == $appointment->member_email)
                <?php $num_of_appointments++;?>            
            @endif
        @endforeach
        <h3>Appointments <small class="text-body-secondary">({{$num_of_appointments}})</small></h3>
    </div>
    <?php $current_appointment = 1?>
    @foreach($appointments as $appointment)
    <div class="accordion w-50 mx-auto" id="accordion{{$appointment->id}}" >
    
        @if(auth()->user()->email == $appointment->member_email)
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$appointment->id}}" aria-expanded="false" aria-controls="collapse{{$appointment->id}}">
            View Appointment {{$current_appointment}} Details
            </button>
            </h2>
            <div id="collapse{{$appointment->id}}" class="accordion-collapse collapse" data-bs-parent="#accordion{{$appointment->id}}">
            <div class="accordion-body">
                @foreach($users as $user)
                    @if($appointment->staff_id == $user->id)
                    Staff Member: {{$user->fname}} {{$user->lname}}<br>
                    @endif
                @endforeach                
                Date: {{$appointment->date}} <br>
                Time Slot: {{$appointment->time}} <br>
                Message: {{$appointment->message}} <br>
                <a href="{{ route('viewMemberAppointments') }}" 
                   onclick="event.preventDefault();
                    document.getElementById(
                      'delete-form-{{$appointment->id}}').submit();" role="button"
                      class="btn custom-button mt-3">
                 Cancel Appoinment 
                </a>
            </div>
            </div>
        </div>
        <?php $current_appointment++?>
        <form id="delete-form-{{$appointment->id}}" 
            + action="{{route('memberAppointment.destroy', $appointment->id)}}"
            method="post">
            @csrf @method('DELETE')
        </form>
        @endif
        
    </div>
    @endforeach
</div>

@endsection