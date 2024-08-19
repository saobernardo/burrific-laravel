<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HelpersController;

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

Route::get('/view404',
  [HelpersController::class, '404-page']
)->name('view404');

require __DIR__."/custom-routes/dashboard-routes.php";
require __DIR__."/custom-routes/cadastrar-participantes-routes.php";
require __DIR__."/custom-routes/makescore-routes.php";
require __DIR__."/custom-routes/dados-participante-routes.php";