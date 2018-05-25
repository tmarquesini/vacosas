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

Route::get('/', function () {
    return response()->redirectToRoute('vacosas.index');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('vacosas', 'VacosasController');
    Route::group(['prefix' => 'vacosas', 'as' => 'contribuicoes.'], function() {
        Route::get('{vacosa}/contribuicoes/adicionar', 'ContribuicoesController@create')->name('create');
        Route::post('{vacosa}/contribuicoes', 'ContribuicoesController@store')->name('store');
        Route::get('{vacosa}/contribuicoes/{contribuicao}/remover', 'ContribuicoesController@confirmDestroy')->name('confirmDestroy');
        Route::delete('contribuicoes/{contribuicao}', 'ContribuicoesController@destroy')->name('destroy');
    });
});
