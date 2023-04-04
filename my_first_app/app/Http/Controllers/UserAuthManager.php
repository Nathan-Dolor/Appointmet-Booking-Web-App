<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAuthManager extends Controller
{
    function login(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    function registration(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Invalid login credentials.");
    }

    function registrationPost(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'tel_number' => 'required',
            'lunch_hour' => 'required',
        ]);

        $data['fname'] = $request->fname;
        $data['lname'] = $request->lname;        
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['tel_number'] = $request->tel_number;
        
        if (!$request->user_type){
            $data['user_type'] = "member";
            $data['lunch_hour'] = NULL;
        }else{
            $data['user_type'] = $request->user_type;
            $data['lunch_hour'] = $request->lunch_hour;
        }       
        
        
        $member = User::create($data);
        if(!$member){
            return redirect(route('registration'))->with("error", "Registration failed, please try again.");
        }
        return redirect(route('login'))->with("success", "Registration successsful, Please Login");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
