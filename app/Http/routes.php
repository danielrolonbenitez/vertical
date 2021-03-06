<?php

Route::get('/', ['as' => 'index', function () {
    return view('index');
}]);

Route::get('/home', ['as' => 'home', function () {
    return view('index');
}]);

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::resource('sessions', 'SessionsController');
Route::post('editcount', 'SessionsController@edit');

Route::group(['middleware' => 'autenticacion'], function () {
	Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('admins', 'AdminController');
    Route::resource('edificios','EdificiosController');
    Route::resource('pisos','PisosController');
    Route::resource('unidades','UnidadesController');
    Route::resource('amenities','AmenitiesController');
    Route::resource('gastos','GastosController');
    Route::resource('reclamos','ReclamosController');
    Route::resource('expensas','ExpensasController');
    Route::resource('notas', 'NotasController');
    Route::resource('perfil','PerfilesController');
    Route::resource('eventos','EventosController');
    Route::get('eventosjson','EventosController@alleventjson');
});

//Route::group(['middleware' => 'autenticacion'], function () {
	Route::resource('contactos','ContactosController');
//});

Route::group(['middleware' => 'autenticacion', 'as' => 'logout'], function () {
	Route::get('logout', 'SessionsController@destroy');
});

Route::post('pass/{users}', [
    'as' => 'users.updatepass', 'uses' => 'UsersController@updatepass'
]);

Route::get('/pdf','PdfController@index');

Route::any('edificios/message/{edificios}', [
    'middleware' => 'autenticacion', 'as' => 'edificios.message', 'uses' => 'EdificiosController@message'
]);

Route::get('propietario/dashboard', [
    'middleware' => 'autenticacion', 'as' => 'propietarios.dashboard', 'uses' => 'DashboardsController@propietario'
]);

Route::get('inquilino/dashboard', [
    'middleware' => 'autenticacion', 'as' => 'inquilinos.dashboard', 'uses' => 'DashboardsController@inquilino'
]);

Route::get('administrador/dashboard', [
    'middleware' => 'autenticacion', 'as' => 'administrador.dashboard', 'uses' => 'DashboardsController@administrador'
]);

Route::get('sistema/dashboard', [
    'middleware' => 'autenticacion', 'as' => 'sistema.dashboard', 'uses' => 'DashboardsController@sistema'
]);

//Route::get('test', [
//    'middleware' => 'autenticacion', 'as' => 'test', 'uses' => 'GastosController@test'
//]);

Route::get('test', [
    'as' => 'test', 'uses' => 'GastosController@test'
]);

Route::get('edificios/propietarios/{unidad}', [
    'middleware' => 'autenticacion', 'as' => 'unidad.propietarios.show', 'uses' => 'UnidadesController@propietarios'
]);

Route::post('edificios/propietarios/{unidad}', [
    'middleware' => 'autenticacion', 'as' => 'unidad.propietarios.store', 'uses' => 'UnidadesController@updatepropietario'
]);

Route::get('edificios/inquilinos/{unidad}', [
    'middleware' => 'autenticacion', 'as' => 'unidad.inquilinos.show', 'uses' => 'UnidadesController@inquilinos'
]);

Route::post('edificios/inquilinos/{unidad}', [
    'middleware' => 'autenticacion', 'as' => 'unidad.inquilinos.store', 'uses' => 'UnidadesController@updateinquilino'
]);

Route::any('validate/usuarioemail', [
    'middleware' => 'autenticacion', 'as' => 'validate.usuarioemail', 'uses' => 'ValidationsController@usuarioEmail'
]);

Route::any('validate/edificiocuit', [
    'middleware' => 'autenticacion', 'as' => 'validate.edificiocuit', 'uses' => 'ValidationsController@edificioCuit'
]);

Route::any('validate/edificiosuterh', [
    'middleware' => 'autenticacion', 'as' => 'validate.edificiosuterh', 'uses' => 'ValidationsController@edificioSuterh'
]);

Route::put('perfil/{perfil}/password', [
    'middleware' => 'autenticacion', 'as' => 'perfil.password', 'uses' => 'PerfilesController@password'
]);

Route::any('validate/unidad', [
    'middleware' => 'autenticacion', 'as' => 'validate.unidad', 'uses' => 'ValidationsController@unidad'
]);

Route::any('validate/administradorcuit', [
    'middleware' => 'autenticacion', 'as' => 'validate.administradorcuit', 'uses' => 'ValidationsController@administradorCuit'
]);
