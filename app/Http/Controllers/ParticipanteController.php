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

    return json_encode($resSelect);
  }

  public function register(Request $request){
    $requestData = $request->all();

    $query = "SELECT id FROM tblparticipantes WHERE nome = ? AND departamento = ?";
    $resSelect = DB::select($query, [$requestData['inputNome'], $requestData['idDepartamento']]);

    if(sizeof($resSelect) > 0){
      throw new Exception(json_encode(["msg" => "Usuário já inserido"]));
    }

    $queryInsert = "INSERT INTO tblparticipantes (nome, departamento)
                  VALUES (?, ?)";
    DB::insert($queryInsert, [$requestData['inputNome'], $requestData['idDepartamento']]);

    return json_encode(["msg" => "Usuário cadastrado com sucesso"]);
  }
}
