<?php

namespace App\Http\Controllers;

use App\Noticia;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class NoticiaController extends Controller
{
    public function Cadastrar(Request $request)
    {
        $noticia = new Noticia();

        if ($request->url_imagem != null) {
            $noticia->titulo_noticia = $request->titulo_noticia;
            $noticia->descricao_noticia = $request->descricao_noticia;
            $noticia->data_noticia = $request->data_noticia;
            $noticia->prioridade_noticia = $request->prioridade_noticia;
            $noticia->url_imagem = $request->file('url_imagem')->store('imagens-noticia');
            $noticia->legenda_imagem = $request->legenda_imagem;
            $status = $noticia->save();

            if ($status == true) {
                return json_encode(["resposta" => "Notícia salva com sucesso"]);
            } else {
                return json_encode(["resposta" => "Ocorreu um problema, tente novamente"]);
            }
        }else {
            $noticia->titulo_noticia = $request->titulo_noticia;
            $noticia->descricao_noticia = $request->descricao_noticia;
            $noticia->data_noticia = $request->data_noticia;
            $noticia->prioridade_noticia = $request->prioridade_noticia;
            $noticia->legenda_imagem = $request->legenda_imagem;
            $status = $noticia->save();

            if ($status == true) {
                return json_encode(["resposta" => "Notícia salva com sucesso"]);
            } else {
                return json_encode(["resposta" => "Ocorreu um problema, tente novamente"]);
            }
        }

    }

    public function ListarNoticiasPrincipal()
    {
        $noticias = DB::select('select * from noticia where prioridade_noticia=? order by id_noticia desc',[
            '1'
        ]);

        if (empty($noticias)) {
            return json_encode(["resposta" => "Nenhuma notícia cadastrada"]);
        } else {
            return $noticias;
        }
    }

    public function ListarNoticiasSegundaria()
    {
        $noticias = DB::select('select * from noticia where prioridade_noticia=? order by id_noticia desc',[
            '0'
        ]);

        if (empty($noticias)) {
            return json_encode(["resposta" => "Nenhuma notícia cadastrada"]);
        } else {
            return $noticias;
        }
    }

    public function DeletarNoticia(Request $request)
    {
        $noticia = DB::select('select url_imagem from noticia where id_noticia=?', [$request->id]);
        if (empty($noticia)) {
            return json_encode(["resposta" => "Essa notícia não existe"]);
        } else {
            foreach ($noticia as $not) {
                $url = $not->url_imagem;
            }
            $url_subs = str_replace("imagens-noticia/", "", $url);
            $status = Storage::delete("imagens-noticia/$url_subs");

            if ($status == true) {
                $noticia = DB::delete('delete from noticia where id_noticia=?', [$request->id]);

                if ($noticia == true) {
                    return json_encode(["resposta" => "Notícia excluida com sucesso"]);
                } else {
                    return json_encode(["resposta" => "Ocorreu um problema, tente novamente"]);
                }
            }
        }
    }

    public function EditarNoticia(Request $request)
    {
        $noticia = DB::select('select * from noticia where id_noticia=?', [$request->id_noticia]);
        if (empty($noticia)) {
            return json_encode(["resposta" => "Essa notícia não existe"]);
        } else {
            if ($request->url_imagem != null) {
                foreach ($noticia as $not) {
                    $url = $not->url_imagem;
                }
                $url_subs = str_replace("imagens-noticia/", "", $url);

                $noticia = DB::update("update noticia set titulo_noticia=?, descricao_noticia=?, data_noticia=?,
                    prioridade_noticia=?, url_imagem=?, legenda_imagem=? where id_noticia=?", [
                    $request->titulo_noticia,
                    $request->descricao_noticia,
                    $request->data_noticia,
                    $request->prioridade_noticia,
                    $request->file('url_imagem')->store('imagens-noticia'),
                    $request->legenda_imagem,
                    $request->id_noticia
                ]);

                if ($noticia == true) {
                    Storage::delete("imagens-noticia/$url_subs");
                    return json_encode(["resposta" => "Notícia editada com sucesso"]);
                } else {
                    return json_encode(["resposta" => "Ocorreu um problema, tente novamente"]);
                }

            } else {
                $noticia = DB::update("update noticia set titulo_noticia=?, descricao_noticia=?,
                data_noticia=?, prioridade_noticia=?, legenda_imagem=? where id_noticia=?",
                    [
                        $request->titulo_noticia,
                        $request->descricao_noticia,
                        $request->data_noticia,
                        $request->prioridade_noticia,
                        $request->legenda_imagem,
                        $request->id_noticia
                    ]);

                if ($noticia == true) {
                    return json_encode(["resposta" => "Notícia editada com sucesso"]);
                } else {
                    return json_encode(["resposta" => "Ocorreu um problema, tente novamente"]);
                }
            }

        }
    }

    public function buscarNoticia(Request $request){
        $noticia = DB::select("select * from noticia where titulo_noticia like '%".$request->nome."%'");

        if(empty($noticia)){
            return json_encode(["resposta" => "Nenhuma notícia cadastrada"]);
        }else {
            return $noticia;
        }
    }

    public function buscarNoticiaID(Request $request){
        $noticia = DB::select("select * from noticia where id_noticia=?",[$request->id]);

        if(empty($noticia)){
            return json_encode(["resposta" => "Nenhuma notícia cadastrada"]);
        }else {
            return $noticia;
        }
    }
}
