<?php
use App\Models\DetalleEgreso;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

//Modulo productos
Route::resource('productos', 'ProductosController');
Route::get('/productos/{atributo}/ordenar', 'ProductosController@ordenarPor');

//Modulo ventas
Route::resource('ventas', 'VentasController');
Route::get('/ventas/{atributo}/ordenar', 'VentasController@ordenarPor');

//Modulo usuarios
Route::resource('usuarios', 'UsuariosController');
Route::get('/usuarios/{atributo}/ordenar', 'UsuariosController@ordenarPor');
Route::get('/usuarios/{id}/habilitar','UsuariosController@habilitar');

//Modulo Compras
Route::resource('compras', 'ComprasController');
Route::get('compras/{id}/mostrarFactura', 'ComprasController@mostrarFactura');
Route::get('compras/{atributo}/ordenar', 'ComprasController@ordenarPor');

//Modulo Configuracion
Route::get('/configuracion/editar', 'ConfiguracionController@editar');
Route::post('/configuracion/configurar', 'ConfiguracionController@configurar');

//Modulo menú
Route::get('/menus', 'MenusController@index');
Route::post('/menus/editar', 'MenusController@editar');
Route::get('/menus/{fecha}/administrar', 'MenusController@administrar');
Route::put('/menus/{fecha}/actualizar', 'MenusController@actualizar')->name('menus.update');

//Modulo pedidos - Usuario
Route::get('/pedidos/create', 'PedidosController@create')->middleware('usuario-registrado');
Route::post('/pedidos', 'PedidosController@store')->middleware('usuario-registrado');
Route::get('/{slug}/pedidos/', 'PedidosController@indexUsuario')->middleware('usuario-registrado');
Route::post('/{slug}/pedidos/filtrarFechas', 'PedidosController@filtrarFechas')->middleware('usuario-registrado');
Route::get('/pedidos/{id}/editar', 'PedidosController@editar')->middleware('usuario-registrado');
Route::put('/pedidos/{id}', 'PedidosController@actualizar')->name('pedidos.update')->middleware('usuario-registrado');

//Modulo pedidos - Staff
Route::get('/pedidos/', 'PedidosController@indexStaff')->middleware('staff');
Route::get('/pedidos/{atributo}/ordenar', 'PedidosController@indexStaff')->middleware('staff');
Route::get('/pedidos/{id}/aceptar', 'PedidosController@aceptarPedido')->middleware('staff');
Route::get('/pedidos/{id}/rechazar', 'PedidosController@rechazarPedido')->middleware('staff');

//Modulo balance
Route::get('/balance/', 'BalanceController@mostrarFechas');
Route::post('/balance/', 'BalanceController@entregarBalance');

Route::post('/bot', 'BotController@solicitud');
Route::get('/bot/menuBroadcast', 'BotController@menuBroadcast')->middleware('staff');

Route::get('/about', 'HomeController@about');

Auth::routes();
;