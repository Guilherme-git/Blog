<?php

use Illuminate\Http\Request;



//Login
    Route::post('login','LoginController@FazerLogin');

//Noticia
    Route::post('cadastrar-noticia','NoticiaController@Cadastrar');
    Route::get('listar-noticias','NoticiaController@ListarNoticiasPrincipal');
    Route::get('listar-noticias-secundarias','NoticiaController@ListarNoticiasSegundaria');
    Route::get('listar-noticias-admin','NoticiaController@ListarNoticiasAdmin');
    Route::delete('delete-noticia/{id}', 'NoticiaController@DeletarNoticia');
    Route::post('editar-noticia','NoticiaController@EditarNoticia');
    Route::get('buscar-noticia/{nome}','NoticiaController@buscarNoticia');
    Route::get('buscar-noticia-id/{id}','NoticiaController@buscarNoticiaID');

//Blog
    Route::post('editar-blog','BlogController@EditarBlog');
    Route::get('detalhe-blog','BlogController@DetalheBlog');


