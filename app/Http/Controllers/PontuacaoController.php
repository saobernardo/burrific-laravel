<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PontuacaoController extends Controller
{
  public function getParticipants(Request $request){
    $query = DB::select("SELECT id, nome FROM tblparticipantes ORDER BY nome ASC");
    return response()->json($query);
  }

  public function register(Request $request){
    $requestData = $request->all();

    DB::insert("INSERT INTO tblburrice_log(id_participante, descricao, pontos, data_ocorrido)
                VALUES (?, ?, ?, CURDATE())", 
                [$requestData['id-participante'], $requestData['form-description'], $requestData['qty-points']]);

    return response()->json(['msg' => 'Pontuação registrada com sucesso']);
  }
}
