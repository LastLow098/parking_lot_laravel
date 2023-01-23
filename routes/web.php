<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;


Route::get('/', [ViewController::class, 'home'])->name("home");
Route::get('/parking', [ViewController::class, 'parking'])->name("parking");
Route::get('/add', [ViewController::class, 'edit']);
Route::get('/edit', [ClientController::class, 'getByClient'])->name('edit');
Route::get('/error', [ViewController::class, 'error'])->name('error');

Route::get('/clients', [ClientController::class, 'getClients']);
Route::get('/auto/no-parking', [AutoController::class, 'getAutoNoParkingByClient']);
Route::get('/auto/parking', [AutoController::class, 'getAutoParking']);

Route::post('/client', [ClientController::class, 'insertClientWithAuto']);
Route::post('/auto', [AutoController::class, 'insertAuto']);
Route::put('/client', [ClientController::class, 'editClient']);
Route::put('/auto', [AutoController::class, 'editAuto']);
Route::delete('/client', [ClientController::class, 'deleteClient']);
Route::delete('/auto', [AutoController::class, 'deleteAuto']);
Route::patch('/auto/set-parking', [AutoController::class, 'setAutoParking']);
