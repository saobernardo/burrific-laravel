<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\models\dashboard;

class ParticipanteController extends Controller
{
  public function getDepartments(Request $request){
    $query = "SELECT id, descricao FROM tbldepartamentos";
    $resSelect = DB::select($query);

    return response()->json($resSelect);
  }

  public function register(Request $request){
    $requestData = $request->all();

    $query = "SELECT id FROM tblparticipantes WHERE nome = ? AND departamento = ?";
    $resSelect = DB::select($query, [$requestData['inputNome'], $requestData['idDepartamento']]);

    if(sizeof($resSelect) > 0){
      return response()->json(["msg" => "Usuário já inserido"], 409);
    }

    $queryInsert = "INSERT INTO tblparticipantes (nome, departamento)
                  VALUES (?, ?)";
    DB::insert($queryInsert, [$requestData['inputNome'], $requestData['idDepartamento']]);

    return response()->json(["msg" => "Usuário cadastrado com sucesso"]);
  }

  public function getAcoesParticipante(Request $request){
    $query = "SELECT tpa.id AS id, tpa.nome AS nome, tb.descricao AS descricao, DATE_FORMAT(tb.data_ocorrido, '%d/%m/%Y') AS data_ocorrido, tb.id AS burriceId
              FROM tblparticipantes tpa INNER JOIN tblburrice_log tb ON tpa.id = tb.id_participante
              WHERE tpa.id = ?";
    $resSelect = DB::select($query, [$_GET['id']]);

    return response()->json($resSelect);
  }

  public function pontosTotalParticipante(){
    $query = "SELECT SUM(tblburrice_log.pontos) AS pontos
              FROM tblburrice_log
              WHERE tblburrice_log.id_participante = ?";
    $resSelect = DB::select($query, [$_GET['id']]);

    return response()->json($resSelect);
  }

  public function apagarRegistro(){
    
  }

  public function desativarParticipante(){}
}
