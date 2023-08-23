<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\AsianController;


Route::get('/paintings', [PaintingController::class,'get_paintings']);
Route::get('/all', [PaintingController::class,'get_all']);

Route::get('/asian', [AsianController::class,'asian_paintings']);
Route::get('/all-a', [AsianController::class,'get_all']);