<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get ('auth/login', [
    'as'   => 'login',
    'uses' => 'Auth\AuthController@getLogin'
]);
Route::post('auth/login',  'Auth\AuthController@postLogin');

Route::get ('auth/logout', [
    'as'   => 'logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Registration routes...
Route::get ('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('test', function() {
   return view('pages.test.sortabletable');
});

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [
        'as'   => 'driver.all',
        'uses' => 'DriversController@all'
    ]);

    // Crear conductor

    Route::get('newConductor', [
        'as'   => 'driver.create',
        'uses' => 'DriversController@create'
    ]);
    Route::post('newConductor', [
        'as'   => 'driver.save',
        'uses' => 'DriversController@store'
    ]);

    // Mostrar conductores

    Route::get('conductores', [
        'as'   => 'driver.all',
        'uses' => 'DriversController@all'
    ]);

    // Actualizar conductor

    Route::get('conductor/{id}', [
        'as'   => 'driver.details',
        'uses' => 'DriversController@details'
    ]);
    Route::post('conductor/{id}', [
        'as'   => 'driver.update',
        'uses' => 'DriversController@update'
    ]);

    // Eliminar conductor
    Route::get('conductorDestroy/{id}', [
        'as'   => 'driver.destroy',
        'uses' => 'DriversController@destroy'
    ]);

    // Crear guagua

    Route::get('newBus', [
        'as'   => 'bus.create',
        'uses' => 'BusesController@create'
    ]);
    Route::post('newBus', [
        'as'   => 'bus.save',
        'uses' => 'BusesController@store'
    ]);

    // Mostrar guaguas

    Route::get('buses', [
        'as'   => 'bus.all',
        'uses' => 'BusesController@all'
    ]);

    // Actualizar guagua

    Route::get('bus/{id}', [
        'as'   => 'bus.details',
        'uses' => 'BusesController@details'
    ]);
    Route::post('bus/{id}', [
        'as'   => 'bus.update',
        'uses' => 'BusesController@update'
    ]);

    // Eliminar guagua

    Route::get('busDestroy/{id}', [
        'as'   => 'bus.destroy',
        'uses' => 'BusesController@destroy'
    ]);

    // Buscar guagua
    Route::post('busSearch', [
        'as'   => 'bus.search',
        'uses' => 'BusesController@search'
    ]);

});