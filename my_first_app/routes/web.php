<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthManager;
use App\Http\Controllers\AppointmentController;

// Landing page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Home page route
Route::get('/home', function () {
    return view('home');
})->name('home');

// Login routes
Route::get('/login', [UserAuthManager::class, 'login'])->name('login');
Route::post('/login', [UserAuthManager::class, 'loginPost'])->name('login.post');

// Registration routes
Route::get('/registration', [UserAuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [UserAuthManager::class, 'registrationPost'])->name('registration.post');

// Logout route
Route::get('/logout', [UserAuthManager::class, 'logout'])->name('logout');

// Book appointment routes
Route::get('/book-appointment', [AppointmentController::class, 'bookAppointment'])->name('bookAppointment');
Route::post('/book-appointment', [AppointmentController::class, 'bookAppointmentPost'])->name('bookAppointment.post');

// View appointment routes
Route::get('/appointments', [AppointmentController::class, 'viewMemberAppointments'])->name('viewMemberAppointments');
Route::get('/staff-appointments', [AppointmentController::class, 'viewStaffAppointments'])->name('viewStaffAppointments');
Route::get('/all-appointments', [AppointmentController::class, 'viewAllAppointments'])->name('viewAllAppointments');

// Delete appointment routes
Route::delete('/member-appointment/{id}', [AppointmentController::class, 'destroyMemberAppointment'])->name('memberAppointment.destroy');
Route::delete('/staff-appointment/{id}', [AppointmentController::class, 'destroyStaffAppointment'])->name('staffAppointment.destroy');