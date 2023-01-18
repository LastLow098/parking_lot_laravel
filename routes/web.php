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

Route::get('/get-clients', [ClientController::class, 'getClients']);
Route::get('/get-auto-no-parking', [AutoController::class, 'getAutoNoParkingByClient']);
Route::get('/get-auto-parking', [AutoController::class, 'getAutoParking']);

Route::post('/add/client', [ClientController::class, 'insertClientWithAuto']);
Route::post('/add/auto', [AutoController::class, 'insertAuto']);
Route::post('/edit/client', [ClientController::class, 'editClient']);
Route::post('/edit/auto', [AutoController::class, 'editAuto']);
Route::post('/delete/client', [ClientController::class, 'deleteClient']);
Route::post('/delete/auto', [AutoController::class, 'deleteAuto']);
Route::post('/set-auto-parking', [AutoController::class, 'setAutoParking']);

