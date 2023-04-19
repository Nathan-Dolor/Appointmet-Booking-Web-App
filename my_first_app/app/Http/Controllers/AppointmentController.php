<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AppointmentController extends Controller
{
    function bookAppointment(){
        $users = User::all();
        $appointments = Appointment::all();
        return view('book_appointment', ['users'=>$users, 'appointments'=>$appointments]);
    }

    function bookAppointmentPost(Request $request){
        $request->validate([
            'staff_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'message' => 'required',
        ]);
        
        $user_email = FacadesAuth::user()->email;

        $data['member_email'] = $user_email;
        $data['staff_id'] = $request->staff_id;        
        $data['date'] = $request->date;
        $data['time'] = $request->time;
        $data['message'] = $request->message;
        
        $appointment = Appointment::create($data);
        if(!$appointment){
            return redirect(route('bookAppointment'))->with("error", "Appoinment booking was unsuccesssful, please try again.");
        }
        return redirect(route('bookAppointment'))->with("success", "Appoinment booked successsfully");
    }

    function viewMemberAppointments(){
        $users = User::all();
        $appointments = Appointment::all();
        return view('view_member_appointments', ['users'=>$users, 'appointments'=>$appointments]);
    }

    function viewStaffAppointments(){
        $users = User::all();
        $appointments = Appointment::all();
        return view('view_staff_appointments', ['users'=>$users, 'appointments'=>$appointments]);
    }

    function viewAllAppointments(){
        $users = User::all()->sortBy('fname');
        $appointments = Appointment::all();
        return view('view_all_appointments', ['users'=>$users, 'appointments'=>$appointments]);
    }

    function updateAppointment(Request $request, $id){
        $appointment_time = $request->input('time');
        $appointment_date = $request->input('date');
        $appointment_message = $request->input('message');
        DB::update('update appointments set time = ?, date = ?, message = ? where id = ?', [$appointment_time, $appointment_date, $appointment_message,$id]);
        return redirect(route('viewMemberAppointments'))->with('success','Appointment Updated');
    }

    public function destroyMemberAppointment($id) 
    {
        $appointment = Appointment::where('id', $id)->firstorfail()->delete();
        return redirect()->route('viewMemberAppointments');
    }

    public function destroyStaffAppointment($id) 
    {
        $appointment = Appointment::where('id', $id)->firstorfail()->delete();
        return redirect()->route('viewStaffAppointments');
    }
}
