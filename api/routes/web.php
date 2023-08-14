<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ObjectController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/objects', 'App\Http\Controllers\ObjectController@show');
// Route::get('/objects', [ObjectController::class, 'index']);
Route::get('/objects', [ObjectController::class, 'test']);


// Route::get('/objects/{objectID}', [App\Http\Controllers\ObjectController::class, 'showId']);

// Route::get('/departments', [App\Http\Controllers\ObjectController::class, 'showDepartments']);
Route::get('/departments', [DepartmentController::class, 'index']);

// Route::get('/object/{objectId}', 'ObjectController@getObjectDetails');
