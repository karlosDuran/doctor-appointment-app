<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('admin.dashboard');
})->name('dashboard');

//Gestion de roles
// En routes/web.php (o routes/admin.php si tienes uno)
Route::resource('roles', RoleController::class)->names('admin.roles');
