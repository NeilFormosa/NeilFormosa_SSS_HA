<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect homepage to Departments index
Route::get('/', function () {
    return redirect()->route('departments.index');
});

// Department CRUD
Route::resource('departments', DepartmentController::class);

// Event CRUD
Route::resource('events', EventController::class);

// Attendee CRUD
Route::resource('attendees', AttendeeController::class);


