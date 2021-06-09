<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
// Home
Route::get('/', 'HomeController@dashboard')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('home');
// Chamados
Route::get('/chamados', 'ChamadosController@index')->name('chamados');
Route::get('/acompanhar/chamados', 'ChamadosController@acompanharChamados')->name('acompanhar_chamados');
Route::get('/gerenciar/chamados', 'ChamadosController@gerenciarChamados')->name('gerenciar_chamados');
Route::post('/chamados', 'ChamadosController@criarChamado')->name('cadastrar_chamado');
Route::post('/search/select/categoria', 'ChamadosController@searchCategoria');
// Setores
Route::get('/setor', 'SetorController@index')->name('setor');
Route::post('/setor', 'SetorController@cadastrarSetor')->name('cadastrar_setor');
Route::get('/listaset/setor', 'SetorController@listasetSetor')->name('listaset');
// Usuario
Route::get('/usuario', 'UsuarioController@index')->name('usuario');
Route::post('/usuario', 'UsuarioController@cadastrarUsuario')->name('cadastrar_usuario');
Route::get('/listausu/usuario', 'UsuarioController@listausuUsuario')->name('listausu');
// Categoria
Route::get('/categoria', 'CategoriaController@index')->name('categoria');
Route::post('categoria', 'CategoriaController@cadastrarCategoria')->name('cadastrar_categoria');
Route::get('/listacat/categoria', 'CategoriaController@listacatCategoria')->name('listacat');

// Problema
Route::get('/problema', 'ProblemaController@index')->name('problema');
Route::post('problema', 'ProblemaController@cadastrarProblema')->name('cadastrar_problema');
Route::get('/listaprob/problema', 'ProblemaController@listaprobProblema')->name('listaprob');