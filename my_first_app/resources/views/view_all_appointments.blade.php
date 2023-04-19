@extends('layout')
@section('content')

<?php $staff_id = 0?>

<div class="mt-3">
    <div class="row w-50 mx-auto">
        <?php $num_of_appointments = 0?>
        @foreach($appointments as $row)
            <?php $num_of_appointments++;?>  
        @endforeach
        <h3>Appointments <small class="text-body-secondary">({{$num_of_appointments}})</small></h3>
    </div>
    <div>
    @foreach($users as $current_user)
        @foreach($appointments as $row)
            @if($row->staff_id == $current_user->id)
                <?php
                $staff_fname = $current_user->fname;
                $staff_lname = $current_user->lname;
                ?>
            
                <div class="accordion w-50 mx-auto " id="accordion{{$row->id}}">
                
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$row->id}}" aria-expanded="false" aria-controls="collapse{{$row->id}}">
                        View Appointment For: {{$staff_fname}} {{$staff_lname}}
                        </button>
                        </h2>
                        <div id="collapse{{$row->id}}" class="accordion-collapse collapse" data-bs-parent="#accordion{{$row->id}}">
                            <div class="accordion-body">
                                @foreach($users as $user)
                                    @if($row->member_email == $user->email)
                                    Club Member: {{$user->fname}} {{$user->lname}}<br>
                                    @endif
                                @endforeach  
                                Staff Member: {{$staff_fname}} {{$staff_lname}} <br>           
                                Date: {{$row->date}} <br>
                                Time Slot: {{$row->time}} <br>
                                Message: {{$row->message}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
    </div>
    
</div>

@endsection
