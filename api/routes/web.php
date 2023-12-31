<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\AsianController;
use App\Http\Controllers\EgyptController;
use App\Http\Controllers\AfricaController;
use App\Http\Controllers\GreekController;
use App\Http\Controllers\IslamicController;
use App\Http\Controllers\AllController;


Route::get('/paintings', [PaintingController::class,'get_paintings']);
Route::get('/all', [PaintingController::class,'get_all']);
Route::get('/all/{objectID}', [PaintingController::class,'getObjectDetails']);
Route::get('/search-p', [PaintingController::class, 'searchPaintings']);

Route::get('/asian', [AsianController::class,'asian_paintings']);
Route::get('/all-a', [AsianController::class,'get_all']);
Route::get('/search-a', [AsianController::class, 'searchPaintings']);


Route::get('/egypt', [EgyptController::class,'egypt_paintings']);
Route::get('/all-e', [EgyptController::class,'get_all']);
Route::get('/search-e', [EgyptController::class, 'searchPaintings']);


Route::get('/africa', [AfricaController::class,'africa_paintings']);
Route::get('/all-af', [AfricaController::class,'get_all']);
Route::get('/search-af', [AfricaController::class, 'searchPaintings']);


Route::get('/greek', [GreekController::class,'greek_paintings']);
Route::get('/all-g', [GreekController::class,'get_all']);
Route::get('/search-g', [GreekController::class, 'searchPaintings']);


Route::get('/islamic', [IslamicController::class,'islamic_paintings']);
Route::get('/all-i', [IslamicController::class,'get_all']);
Route::get('/search-i', [IslamicController::class, 'searchPaintings']);


Route::get('/total', [AllController::class,'all_paintings']);
Route::get('/total/{objectID}', [AllController::class,'getObjectDetails']);
Route::get('/all-p', [AllController::class,'get_all']);