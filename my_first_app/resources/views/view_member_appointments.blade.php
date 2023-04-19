@extends('layout')
@section('content')

<div class=" mt-3">
    <div class="container mt-5">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
            {{session()->get('success')}}</div>
        @endif
    </div>  
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
                    <?php $appointment_id = $appointment->id ?>
                    <?php $staff_id = $user->id ?>
                    @endif
                @endforeach               
                Date: {{$appointment->date}} <br>
                Time Slot: {{$appointment->time}} <br>
                Message: {{$appointment->message}} <br>
                <a class="btn btn-primary mt-3" id="{{$current_appointment}}-{{$appointment_id}}-{{$staff_id}}" onclick="displayForm(this.id)">
                 <strong>Update Appoinment</strong> 
                </a>
                <a href="{{ route('viewMemberAppointments') }}" 
                   onclick="event.preventDefault();
                    document.getElementById(
                      'delete-form-{{$appointment->id}}').submit();" role="button"
                      class="btn custom-button mt-3">
                 Cancel Appoinment 
                </a>
                <div id="update-form-{{$current_appointment}}" style="display: none">
                    <hr>
                    <form action="/update/{{$appointment->id}}" method="post" class="me-auto mt-3 row g-3" style="width: 500px;">  
                        @csrf    
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" id="date-picker-{{$current_appointment}}" name="date" min="2015-10-28">
                        </div>    
                        <div class="mb-3 col-md-6">
                            <label for="time-slot" class="mb-2">Time Slot</label>
                            <select class="form-select" id="time-slot-{{$current_appointment}}" name="time">
                                <option value="" disabled selected hidden>--select--</option>
                                <option value="8am - 9am">8am - 9am</option>
                                <option value="9am - 10am">9am - 10am</option>
                                <option value="10am - 11am">10am - 11am</option>
                                <option value="11am - 12pm">11am - 12pm</option>
                                <option value="12pm - 1pm">12pm - 1pm</option>
                                <option value="1pm - 2pm">1pm - 2pm</option>
                            </select>
                        </div>    
                        <div class="mb-3">
                            <label class="form-label">Appointment Purpose</label>
                            <textarea class="form-control" name="message" id="purpose-{{$current_appointment}}"></textarea>
                        </div>
                        <div class="d-grid text-center col-md-6">
                            <button type="submit" class="btn custom-button">Save</button>
                        </div>
                        <div class="d-grid text-center col-md-6">
                            <a class="btn custom-button" id="cancel-{{$current_appointment}}" onclick="cancelUpdate(this.id)">Cancel</a>
                        </div>
                    </form>
                </div>
                
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

<script>
    window.onload=function(){
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("date")[0].setAttribute('min', today);
    }

    function displayForm(id){
        var form_id = id.split("-")[0];
        var appointment_id = id.split("-")[1];
        var staff_id = id.split("-")[2];
        console.log(appointment_id);
        var form = document.getElementById('update-form-' + form_id);
        if (form.style.display == "none") {
            form.style.display = "block";
        }else{
            form.style.display = "none";
        }
        
        <?php
        foreach($appointments as $row){
        ?>
            var id = "<?php echo $row->id ?>";
            if (parseInt(id) == parseInt(appointment_id)) {
                // document.getElementById("time-slot-" + form_id).value = <?php echo $row->time ?>;
                document.getElementById('purpose-' + form_id).value = "<?php echo $row->message ?>";
                document.getElementById('date-picker-' + form_id).value = "<?php echo $row->date ?>";
                document.getElementById('time-slot-' + form_id).value = "<?php echo $row->time ?>";
            }    
        <?php 
        }
        ?>

        <?php
        foreach($users as $row){
        ?>
            var id = "<?php echo $row->id ?>";
            if (parseInt(id) == parseInt(staff_id)) {
                for (let index = 0; index < 6; index++) {
                    var option = document.getElementById("time-slot-" + form_id).options[index];
                    if(option.value == "<?php echo $row->lunch_hour; ?>"){
                        option.disabled = true;
                    }
                }
            }    
        <?php 
        }
        ?>

        var dateInput = document.getElementById("date-picker-" + form_id);
        dateInput.addEventListener("change", function(event) {
            var dateValue = event.target.value;
            var dateTime = luxon.DateTime.fromISO(dateValue);
            var dayName = dateTime.toFormat('EEEE');
            
            if (dayName == "Friday") {
                var selectElement = document.getElementById("time-slot-" + form_id);

                var optionElement = document.createElement("option");
                optionElement.value = "2pm - 3pm";
                optionElement.text = "2pm - 3pm";

                selectElement.add(optionElement);
            }else{
                var selectElement = document.getElementById("time-slot-" + form_id);

                var optionElement = selectElement.querySelector('option[value="2pm - 3pm"]');

                if (optionElement) {
                    selectElement.removeChild(optionElement);
                }
            }

            <?php
            foreach($appointments as $row){
            ?>
                var appointmentDate = "<?php echo $row->date ?>";
                var datePicker = document.getElementById("date-picker-" + form_id);
                var selectedDate = datePicker.value;
                if (appointmentDate == selectedDate) {
                    var appointmentTime = "<?php echo $row->time ?>";
                    var selectElement = document.getElementById("time-slot-" + form_id);
                    var optionElement = selectElement.querySelector('option[value="' + appointmentTime + '"]');
                    optionElement.disabled = true;
                }    
            <?php 
            }
            ?>
        });
    }

    function cancelUpdate(id){
        document.getElementById('update-form-' + id[7]).style.display = "none";
    }
    
</script>

@endsection