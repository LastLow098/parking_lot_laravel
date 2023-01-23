<?php

use App\Http\Controllers\ApiAutoController;
use App\Http\Controllers\AutoController;
use Illuminate\Support\Facades\Route;


// API for autos

Route::get('/auto/no-parking', [AutoController::class, 'getAutoNoParkingByClient']);
Route::get('/auto/parking', [AutoController::class, 'getAutoParking']);

Route::post('/auto', [ApiAutoController::class, 'insertAuto']);
Route::patch('/auto', [ApiAutoController::class, 'editAuto']);
Route::patch('/auto/set-parking', [ApiAutoController::class, 'setAutoParking']);
Route::delete('/auto', [ApiAutoController::class, 'deleteAuto']);

