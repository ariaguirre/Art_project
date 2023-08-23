<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\PaintingController;

// use App\Http\Controllers\ArtworkController;

// Route::get('/objects', [ObjectController::class, 'index']);
// Route::get('/africa', [ObjectController::class, 'africa']);
// Route::get('/asia', [ObjectController::class, 'asia']);
// Route::get('/egypt', [ObjectController::class, 'egypt']);
// Route::get('/greek', [ObjectController::class, 'greek']);
// Route::get('/islamic', [ObjectController::class, 'islamic']);


// Route::get('/objects/{objectID}', [App\Http\Controllers\ObjectController::class, 'getObjectDetails']);

// // Route::get('/departments', [App\Http\Controllers\ObjectController::class, 'showDepartments']);
// Route::get('/departments', [DepartmentController::class, 'index']);


// Route::get('/artworks', [ArtworkController::class, 'get_objects']);

// Route::get('/paintings', [PaintingController::class,'index'])->name('painting.index');

Route::get('/paintings', [PaintingController::class,'get_paintings']);
Route::get('/all', [PaintingController::class,'get_all']);