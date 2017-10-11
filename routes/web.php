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
    // return view('auth.login2');
    return redirect('/login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/consultas', 'ConsultaController@getConsultas')->name('consultas');
Route::post('/consultas', 'ConsultaController@postConsultas')->name('consultas');

Route::group(['namespace' => 'Auth', 'prefix' => 'admin'], function (){
	// Registro de usuarios
	Route::get('/usuarios', 'UsuarioController@getUsuarios')->name('usuarios');
	Route::post('/usuarios', 'UsuarioController@postUsuarios')->name('usuarios');
	// Cambio de contraseña por el mismo usuario
	Route::get('/password', 'UsuarioController@getPassword')->name('password');
	Route::post('/password', 'UsuarioController@postPassword')->name('password');
	// Pantalla de perfil del usuario
	Route::get('/perfil', 'UsuarioController@getPerfil')->name('perfil');
	Route::post('/perfil', 'UsuarioController@postPerfil')->name('perfil');
	//Cargar y eliminar foto de perfil de usuario
	Route::post('/fotoc', 'UsuarioController@postCargarfoto')->name('fotoc');
	Route::post('/fotoe', 'UsuarioController@postEliminarfoto')->name('fotoe');
	// Recuperar y reiniciar contraseña
	Route::post('/recuperar', 'RecuperarController@postRecuperar')->name('recuperar');
	Route::post('/reiniciar', 'UsuarioController@postReiniciar')->name('reiniciar');

});