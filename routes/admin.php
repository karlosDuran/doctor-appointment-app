<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InsuranceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Gestion de roles
Route::resource('roles', RoleController::class)->names('admin.roles');

// Gestion de usuarios
Route::resource('users', UserController::class)->names('admin.users');

// Gestion de pacientes
Route::resource('patients', PatientController::class)->names('admin.patients');

// Gestión de doctores
Route::resource('doctors', DoctorController::class)->names('admin.doctors');

// Gestión de aseguradoras
Route::resource('insurances', InsuranceController::class)->names('admin.insurances');

// Gestión de citas médicas
Route::resource('appointments', AppointmentController::class)->names('admin.appointments');
Route::get('appointments/{appointment}/consult', [AppointmentController::class, 'consult'])->name('admin.appointments.consult');

// Horarios de doctores
Route::get('doctors/{doctor}/schedules', [ScheduleController::class, 'index'])->name('admin.doctors.schedules');

// Importación masiva de pacientes
Route::get('imports', \App\Livewire\Admin\PatientImporter::class)->name('admin.imports');
