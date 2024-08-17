<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipanteController;

Route::get('/get-acoes',
  [ParticipanteController::class, 'getAcoesParticipante']
)->name('getAcoes');

Route::get('/pontos-participante',
  [ParticipanteController::class, 'pontosTotalParticipante']
)->name('pontosParticipante');