<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function FazerLogin(Request $request){
        $usuario = DB::select('select * from admin where email_admin=? and senha_admin=?', [
            $request->email,
            $request->senha
        ]);

        if(empty($usuario)){
            return json_encode(["resposta" => "Esse usuário não está cadastrado"]);
        }else {
            return $usuario;
        }
    }
}
