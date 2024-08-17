<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\models\DashboardModel;

class Dashboard extends Controller
{
  public function viewDashboard(Request $request){
    return view('dashboard.index');
  }

  public function ajaxTableLastBurrices(Request $request){
    $query = "SELECT tpa.id as id, tpa.nome AS nome, SUM(tb.pontos) AS pontos, MAX(tb.descricao) AS descricao FROM tblparticipantes tpa INNER JOIN tblburrice_log tb ON tpa.id = tb.id_participante GROUP BY tpa.id ORDER BY tb.data_ocorrido DESC LIMIT 5";
    $resSelect = DB::select($query);

    return response()->json($resSelect);
  }

  public function ajaxGraphic(Request $request){
    $query = "SELECT tblparticipantes.nome, SUM(tblburrice_log.pontos) AS pontos 
    FROM tblparticipantes INNER JOIN tblburrice_log ON tblparticipantes.id = tblburrice_log.id_participante 
    WHERE tblburrice_log.data_ocorrido >= DATE_SUB(NOW(), INTERVAL 6 MONTH) GROUP BY tblparticipantes.id ORDER BY pontos DESC LIMIT 8";
    $resSelect = DB::select($query);

    return response()->json($resSelect);
  }

  public function viewParticipantesDetalhes(Request $request){
    return view('participant-page.index');
  }
}
