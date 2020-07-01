<?php

use Illuminate\Http\Request;



    //Login
    Route::post('login','LoginController@FazerLogin');

//Noticia
    Route::post('cadastrar-noticia','NoticiaController@Cadastrar');
    Route::get('listar-noticias','NoticiaController@ListarNoticias');
    Route::delete('delete-noticia/{id}', 'NoticiaController@DeletarNoticia');
    Route::post('editar-noticia','NoticiaController@EditarNoticia');

//Blog
    Route::post('editar-blog','BlogController@EditarBlog');
    Route::get('detalhe-blog','BlogController@DetalheBlog');


