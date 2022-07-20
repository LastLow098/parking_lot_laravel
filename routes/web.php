<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


Route::get('/', [MainController::class, 'home'])->name("home");

Route::get('/parking', [MainController::class, 'parking'])->name("parking");

Route::get('/add', [MainController::class, 'edit']);

Route::get('/edit', [MainController::class, 'getByClient'])->name('edit');

Route::get('/error', [MainController::class, 'error'])->name('error');

Route::post('/add/client', [MainController::class, 'insertClientWithAuto']);

Route::post('/add/auto', [MainController::class, 'insertAuto']);

Route::post('/edit/client', [MainController::class, 'editClient']);

Route::post('/edit/auto', [MainController::class, 'editAuto']);

Route::post('/delete/client', [MainController::class, 'deleteClient']);

Route::post('/delete/auto', [MainController::class, 'deleteAuto']);

Route::get('/get-clients', [MainController::class, 'getClients']);

Route::get('/get-auto-parking', [MainController::class, 'getAutoParking']);

