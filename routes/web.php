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
Route::get('/', 'HomeController@dashboard')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chamados', 'ChamadosController@index')->name('chamados');
Route::get('/acompanhar/chamados', 'ChamadosController@acompanharChamados')->name('acompanhar_chamados');
Route::post('/chamados', 'ChamadosController@criarChamado')->name('cadastrar_chamado');
Route::post('/search/select/categoria', 'ChamadosController@searchCategoria');
