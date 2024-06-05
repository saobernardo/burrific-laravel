<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrarParticipanteController;

Route::get('/get-departments',
  [RegistrarParticipanteController::class, 'getDepartments']
)->name('getDepartments');