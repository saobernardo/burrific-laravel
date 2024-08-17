<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipanteController;

Route::get('/get-acoes',
  [ParticipanteController::class, 'getAcoesParticipante']
)->name('getAcoes');