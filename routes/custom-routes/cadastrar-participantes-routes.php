<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrarParticipanteController;

Route::get('/get-departments',
  [Dashboard::class, 'getDepartments']
)->name('getDepartments');