<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/objects', 'App\Http\Controllers\ObjectController@show');

Route::get('/objects/{objectID}', [App\Http\Controllers\ObjectController::class, 'showId']);

// Route::get('/departments', [App\Http\Controllers\ObjectController::class, 'showDepartments']);
Route::get('/departments', [DepartmentController::class, 'index']);