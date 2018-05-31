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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/vacosas/fechadas', 'VacosasController@fechadas')->name('vacosas.fechadas');
    Route::resource('vacosas', 'VacosasController');

    Route::group(['prefix' => 'vacosas', 'as' => 'contribuicoes.'], function () {
        Route::get('{vacosa}/contribuicoes/adicionar', 'ContribuicoesController@create')->name('create');
        Route::post('{vacosa}/contribuicoes', 'ContribuicoesController@store')->name('store');
        Route::get('{vacosa}/contribuicoes/{contribuicao}/remover', 'ContribuicoesController@confirmDestroy')->name('confirmDestroy');
        Route::delete('contribuicoes/{contribuicao}', 'ContribuicoesController@destroy')->name('destroy');
    });
    Route::group(['prefix' => 'usuarios', 'as' => 'users.'], function () {
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('{user}', 'UsersController@show')->name('show');
        Route::put('{user}/bloquear', 'UsersController@block')->name('block');
        Route::put('{user}/desbloquear', 'UsersController@unblock')->name('unblock');
        Route::put('{user}/setAsAdmin', 'UsersController@setAsAdmin')->name('setAsAdmin');
        Route::put('{user}/setAsUser', 'UsersController@setAsUser')->name('setAsUser');
        Route::delete('delete/{user}', 'UsersController@destroy')->name('destroy');
    });
});
