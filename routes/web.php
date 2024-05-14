<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrarParticipanteController;
use App\Http\Controllers\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 
    [Dashboard::class, 'viewDashboard']
)->name('dashboard');

Route::get('/get-last-burrices',
    [Dashboard::class, 'ajaxTableLastBurrices']
)->name('getLastBurrice');

Route::post('/registrar-participante', 
    [RegistrarParticipanteController::class, 'register']
)->name('saveItem');