<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNoticia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia', function (Blueprint $table) {
            $table->bigIncrements('id_notifica');
            $table->string("titulo_noticia");
            $table->string("descricao_noticia");
            $table->string("data_noticia");
            $table->enum("prioridade_noticia",['0', '1']);
            $table->string("imagem_noticia");
            $table->string('legenda_imagem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticia');
    }
}
