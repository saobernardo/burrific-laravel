<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MenuController;

Route::get('/participant-details-page',
  [Dashboard::class, 'viewParticipantesDetalhes']
)->name('participanteDetalhesPage');

Route::get('/cadastrar-participante-page',
  [MenuController::class, 'viewCadastrarParticipante']
)->name('cadastrarParticipantesPage');

Route::get('/registrar-pontos-page',
  [MenuController::class, 'viewRegistrarPontos']
)->name('registrarPontosPage');

//Ajax
Route::get('/get-last-burrices',
  [Dashboard::class, 'ajaxTableLastBurrices']
)->name('getLastBurrice');

Route::get('/get-graphic-data',
  [Dashboard::class, 'ajaxGraphic']
)->name('getGraphicData');