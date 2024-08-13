<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PontuacaoController;

Route::get("/get-participants",
  [PontuacaoController::class, 'getParticipants']
)->name('getParticipants');

Route::post("/points-register",
  [PontuacaoController::class, 'register']
)->name('pointsRegister');