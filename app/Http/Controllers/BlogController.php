<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function EditarBlog(Request $request){
        $blog = DB::insert('update blog set nome_blog=?, descricao_blog=?',[
            $request->nome_blog,
            $request->descricao_blog
        ]);

        if($blog == true){
            return json_encode(["resposta"=>"Alteração realizada com sucesso"]);
        }else {
            return json_encode(["resposta"=>"Ocorreu um erro, tente novamente"]);
        }
    }

    public function DetalheBlog(Request $request){
        $blog = DB::select("select * from blog");

        if(empty($blog)){
            return json_encode(["resposta"=>"Nenhuma informação do blog salva"]);
        }else {
            return $blog;
        }
    }
}
