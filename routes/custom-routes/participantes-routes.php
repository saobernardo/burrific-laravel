<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipanteController;

Route::get('/get-departments',
  [ParticipanteController::class, 'getDepartments']
)->name('getDepartments');

Route::post('/new-participant',
  [ParticipanteController::class, 'register']
)->name('newParticipant');