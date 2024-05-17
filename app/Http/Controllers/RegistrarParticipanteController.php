<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\models\dashboard;

class RegistrarParticipanteController extends Controller
{
  public function getDepartments(Request $request){
    $query = "SELECT id, descricao FROM tbldepartamentos";
    $resSelect = DB::select($query);

    return json_encode($resSelect);
  }

  public function register(Request $request){
    
  }
}
