<?php

use App\Http\Controllers\ApiAutoController;
use App\Http\Controllers\AutoController;
use Illuminate\Support\Facades\Route;


// API for autos

Route::get('/auto/no-parking/{id}', [ApiAutoController::class, 'getAutoNoParkingByClient']);
Route::get('/auto/parking', [AutoController::class, 'getAutoParking']);

Route::post('/auto', [ApiAutoController::class, 'insertAuto']);
Route::put('/auto/{id}', [ApiAutoController::class, 'editAuto']);
Route::put('/auto/set-parking/{id}', [ApiAutoController::class, 'setAutoParking']);
Route::delete('/auto/{id}', [ApiAutoController::class, 'deleteAuto']);

