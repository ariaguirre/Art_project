<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ObjectController;

Route::get('/objects', [ObjectController::class, 'index']);
Route::get('/africa', [ObjectController::class, 'africa']);
Route::get('/asia', [ObjectController::class, 'asia']);


Route::get('/objects/{objectID}', [App\Http\Controllers\ObjectController::class, 'getObjectDetails']);

// Route::get('/departments', [App\Http\Controllers\ObjectController::class, 'showDepartments']);
Route::get('/departments', [DepartmentController::class, 'index']);

