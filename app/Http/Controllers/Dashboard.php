<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\models\DashboardModel;

class Dashboard extends Controller
{
  public function viewDashboard(Request $request){
    return view('dashboard.index');
  }

  public function viewCadastrarParticipante(Request $request){}

  public function viewRegistrarPontos(Request $request){}

  public function viewColaborador(Request $request){}

  public function viewRankings(Request $request){}

  public function ajaxTableLastBurrices(Request $request){
    $query = "SELECT tpa.id as id, tpa.nome AS nome, SUM(tb.pontos) AS pontos, MAX(tb.descricao) AS descricao FROM tblparticipantes tpa INNER JOIN tblburrice_log tb ON tpa.id = tb.id_participante GROUP BY tpa.id ORDER BY tb.data_ocorrido DESC LIMIT 5";
    $resSelect = DB::select($query);

    return json_encode($resSelect);
  }
}
