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
        <h4 class="text-center">Book Appointment</h4>
        <form action="{{route('bookAppointment.post')}}" method="POST" class="ms-auto me-auto mt-3 row g-3" style="width: 400px">
            @csrf
            <div class="mb-1" id="staff_member">
                <label for="autoSizingSelect" class="mb-2">Staff Member</label>
                <select class="form-select" id="staff_member" name="staff_id" onchange="handleSelectChange(event)">
                    <option value="" disabled selected hidden>--select--</option>
                    @foreach($users as $row)                    
                        @if($row->user_type == "staff")
                            <option value="{{$row->id}}">{{$row->fname}} {{$row->lname}}</option>
                        @endif
                    @endforeach
                </select>
            </div>    
            <p style="margin: 0;"> <em id="info"></em> </p>     
            <div class="mb-3 col-md-6">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" id="date_picker" name="date" min="2015-10-28">
            </div>    
            <div class="mb-3 col-md-6">
                <label for="time_slot" class="mb-2">Time Slot</label>
                <select class="form-select" id="time_slot" name="time">
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
                <textarea class="form-control" name="message"></textarea>
            </div>
            <div class="d-grid text-center">
                <button type="submit" class="btn custom-button">Book</button>
            </div>
        </form>


    </div>

    <script>
        window.onload=function(){
            var today = new Date().toISOString().split('T')[0];
            document.getElementsByName("date")[0].setAttribute('min', today);
        }

        function handleSelectChange(event) {

            var selectElement = event.target;
            var value = selectElement.value;

            <?php
            foreach($users as $row){
            ?>
                var id = "<?php echo $row->id ?>";
                if (parseInt(id) == parseInt(value)) {
                    document.getElementById("info").innerHTML = "*<?php echo $row->fname; ?> has a lunch hour from <?php echo $row->lunch_hour; ?>*"
                    for (let index = 0; index < 6; index++) {
                        var option = document.getElementById("time_slot").options[index];
                        if(option.value == "<?php echo $row->lunch_hour; ?>"){
                            option.disabled = true;
                        }
                        else if(option.disabled == true){
                            option.disabled = false;
                        }
                    }
                }    
            <?php 
            }
            ?>
        }

		var dateInput = document.getElementById("date_picker");
        dateInput.addEventListener("change", function(event) {
            var dateValue = event.target.value;
            var dateTime = luxon.DateTime.fromISO(dateValue);
            var dayName = dateTime.toFormat('EEEE');
            
            if (dayName == "Friday") {
                var selectElement = document.getElementById("time_slot");

                var optionElement = document.createElement("option");
                optionElement.value = "2pm - 3pm";
                optionElement.text = "2pm - 3pm";

                selectElement.add(optionElement);
            }else{
                var selectElement = document.getElementById("time_slot");

                var optionElement = selectElement.querySelector('option[value="2pm - 3pm"]');

                if (optionElement) {
                    selectElement.removeChild(optionElement);
                }
            }

            <?php
            foreach($appointments as $row){
            ?>
                var appointmentDate = "<?php echo $row->date ?>";
                var datePicker = document.getElementById("date_picker");
			    var selectedDate = datePicker.value;
                if (appointmentDate == selectedDate) {
                    var appointmentTime = "<?php echo $row->time ?>";
                    var selectElement = document.getElementById("time_slot");
                    var optionElement = selectElement.querySelector('option[value="' + appointmentTime + '"]');
                    optionElement.disabled = true;
                }    
            <?php 
            }
            ?>
        });
    </script>
    
@endsection