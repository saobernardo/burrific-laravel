<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\models\MenuModel;

class MenuController extends Controller
{
  public function viewCadastrarParticipante(Request $request){
    return view('insert-participants.index');
  }

  public function viewRegistrarPontos(Request $request){
    return view('make-score.index');
  }
}
