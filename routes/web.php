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
Route::get('/home', 'HomeController@getHome')->name('home');
Route::get('/dashboard', 'HomeController@getDashboard')->name('dashboard');
Route::post('/ver_noticia', 'HomeController@postNoticia')->name('ver_noticia');

Route::post('/facturacion', 'HomeController@postFacturacion')->name('facturacion');
Route::post('/filtrarwidget', 'HomeController@postFiltrarwidget')->name('filtrarwidget');

Route::get('/consultas', 'ConsultaController@getConsultas')->name('consultas');
Route::post('/consultas', 'ConsultaController@postConsultas')->name('consultas');
Route::post('/detallesDTE', 'ConsultaController@postBuscardetalle')->name('detallesDTE');
Route::post('/trazaDTE', 'ConsultaController@postBuscartraza')->name('trazaDTE');

Route::get('/oc', 'OrdencController@getOrdenCompra')->name('oc');
Route::post('/oc', 'OrdencController@postOrdenCompra')->name('oc');

Route::get('/Reg_proveedores', 'ProveedorController@getRegProveedores')->name('Reg_proveedores');
Route::post('/Reg_proveedores', 'ProveedorController@postRegProveedores')->name('Reg_proveedores');

// Activar o Desactivar usuario
Route::post('/activarPro', 'ProveedorController@postProveedoractivo')->name('activarPro');

Route::get('/proveedores', 'ProveedorController@getProveedores')->name('proveedores');
Route::post('/proveedores', 'ProveedorController@postProveedores')->name('proveedores');
Route::post('/detallesProveedor', 'ProveedorController@postBuscardetalleP')->name('detallesProveedor');
Route::post('/activarE', 'ProveedorController@postEmpresactiva')->name('activarE');
Route::post('/desbloquearCP', 'ProveedorController@postDesbloquearcuentaproveedor')->name('desbloquearCP');

//Mostrar Perfiles de los usuarios (Activar / Desactivar)
Route::get('/empresas', 'ProveedorController@getEmpresas')->name('empresas');
Route::post('/empresas', 'ProveedorController@postEmpresas')->name('empresas');

Route::get('/clientes', 'ClienteController@getClientes')->name('clientes');
Route::post('/clientes', 'ClienteController@postClientes')->name('clientes');
Route::post('/detallesCliente', 'ClienteController@postBuscardetalleC')->name('detallesCliente');

Route::get('/publicaciones', 'PublicacionesController@getPublicaciones')->name('publicaciones');
Route::get('/listpublicaciones', 'PublicacionesController@getListpublicaciones')->name('listpublicaciones');
Route::post('/publicaciones', 'PublicacionesController@postPublicaciones')->name('publicaciones');
// Activar o Desactivar publicacion
Route::post('/activarPu', 'PublicacionesController@postPublicacionactivo')->name('activarPu');

// Chat en vivo para proveedores
Route::get('/chat', 'ChatController@getChat')->name('chat');
Route::post('/chat', 'ChatController@postChat')->name('chat');
Route::get('/chatC', 'ChatController@getChatcliente')->name('chatC');
// Cambiar status a la conversacion (Leido)
Route::post('/statusChat', 'ChatController@postStatuschat')->name('statusChat');

//Buzon de mensajes (Clientes)
Route::get('/buzon', 'ChatController@getBuzon')->name('buzon');
// Conversaciones entre proveedores y clientes
Route::get('/conversacion', 'ChatController@getConversacion')->name('conversacion');

Route::group(['namespace' => 'Auth', 'prefix' => 'admin'], function (){
	//accesos (Seleccionar acceso para ingresar a la aplicacion)
	Route::get('/accesos', 'UsuarioController@getAccesos')->name('accesos');
	Route::post('/accesos', 'UsuarioController@postAccesos')->name('accesos');
	//Mostrar Perfiles de los usuarios (Activar / Desactivar)
	Route::get('/perfiles', 'UsuarioController@getPerfiles')->name('perfiles');
	Route::post('/perfiles', 'UsuarioController@postPerfiles')->name('perfiles');
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
	// Activar o Desactivar usuario
	Route::post('/activar', 'UsuarioController@postUsuarioactivo')->name('activar');
	// Activar o Desactivar Perfil de usuario
	Route::post('/activarP', 'UsuarioController@postPerfilactivo')->name('activarP');
	// Desbloquear cuenta de usuario por maximo de intentos fallídos
	Route::post('/desbloquearC', 'UsuarioController@postDesbloquearcuenta')->name('desbloquearC');
});