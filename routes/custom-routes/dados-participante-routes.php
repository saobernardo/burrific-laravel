<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipanteController;

Route::get('/edit-participant-page',
  [ParticipanteController::class, 'viewEditParticipantPage']
)->name('editParticipantPage');

Route::get('/get-acoes',
  [ParticipanteController::class, 'getAcoesParticipante']
)->name('getAcoes');

Route::get('/pontos-participante',
  [ParticipanteController::class, 'pontosTotalParticipante']
)->name('pontosParticipante');

Route::delete('/excluir-registro-participante', 
  [ParticipanteController::class, 'apagarRegistro']
)->name('excluirRegistroParticipante');