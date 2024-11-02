<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\models\dashboard;

class ParticipanteController extends Controller
{
  public function viewEditParticipantPage(){
    return view('partipant-page.edit-participant');
  }

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

    return response()->json(["msg" => "Usuário cadastrado com sucesso"], 200);
  }

  public function getAcoesParticipante(Request $request){
    $query = "SELECT tpa.id AS id, tpa.nome AS nome, tb.descricao AS descricao, DATE_FORMAT(tb.data_ocorrido, '%d/%m/%Y') AS data_ocorrido, tb.id AS burriceId
              FROM tblparticipantes tpa INNER JOIN tblburrice_log tb ON tpa.id = tb.id_participante
              WHERE tpa.id = ?";
    $resSelect = DB::select($query, [$_GET['id']]);

    return response()->json($resSelect, 200);
  }

  public function pontosTotalParticipante(){
    $query = "SELECT SUM(tblburrice_log.pontos) AS pontos
              FROM tblburrice_log
              WHERE tblburrice_log.id_participante = ?";
    $resSelect = DB::select($query, [$_GET['id']]);

    return response()->json($resSelect, 200);
  }

  public function apagarRegistro(Request $request){
    $query = "DELETE FROM tblburrice_log WHERE id = ?";
    DB::delete($query, [$_GET['id']]);

    return response()->json(["msg" => "Registro excluído com sucesso"], 200);
  }

  public function desativarParticipante(){}

  public function editarParticipante(Request $request){
    $requestData = $request->all();

    $query = "UPDATE tblparticipantes SET nome = ?, departamento ? WHERE id = ?";
    DB::update($query, [$requestData['inputNome'], $requestData['selectDepartamento'], $requestData['id']]);

    return response()->json(["msg" => "Registro editado com sucesso"], 200);
  }
}
