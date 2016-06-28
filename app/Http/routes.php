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

Route::get ('login', 'Auth\AuthController@getLogin')->name('login');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get ('logout', 'Auth\AuthController@getLogout')->name('logout');

Route::post ('password/email', 'Auth\PasswordController@postEmail')->name('passwordEmail');

// Password reset routes...
Route::get ('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('passwordReset');

Route::get('test', function() {
   return view('pages.test.sortabletable');
});

// Drivers
Route::group(['middleware' => 'auth'], function() {

    Route::get('user',      'UserController@resume')->name('user_profile.resume');
    Route::get('userImage', 'UserController@getProfileImage')->name('user_profile.image');
    Route::post('user',     'UserController@update')->name('user_profile.update');

});

// Drivers
Route::group(['middleware' => 'auth'], function() {

    // INDEX
    Route::get ('/', 'DriversController@all')->name('home');

    Route::get ('drivers', 'DriversController@all')->name('driver.resume');

    Route::post('driverSearch', 'DriversController@search')->name('driver.search');

    Route::get ('newDriver', 'DriversController@create')->name('driver.create');
    Route::post('newDriver', 'DriversController@store')->name('driver.save');

    Route::get ('driver/{id}', 'DriversController@details')->name('driver.details');
    Route::post('driver/{id}', 'DriversController@update')->name('driver.update');

    Route::get ('driverDestroy/{id}', 'DriversController@destroy')->name('driver.destroy');
    Route::delete ('driverDestroy/{id}', 'DriversController@destroy')->name('driver.destroy');

});

// Buses
Route::group(['middleware' => 'auth'], function() {

    Route::get ('buses', 'BusesController@all')->name('bus.resume');

    Route::post('busSearch', 'BusesController@search')->name('bus.search');

    Route::get ('newBus', 'BusesController@create')->name('bus.create');
    Route::post('newBus', 'BusesController@store')->name('bus.save');

    Route::get ('bus/{id}', 'BusesController@details')->name('bus.details');
    Route::post('bus/{id}', 'BusesController@update')->name('bus.update');

    Route::get ('busDestroy/{id}', 'BusesController@destroy')->name('bus.destroy');
    Route::delete('busDestroy/{id}', 'BusesController@destroy')->name('bus.destroy');


});

// Lines
Route::group(['middleware' => 'auth'], function() {

    Route::get ('lines', 'LinesController@all')->name('line.resume');

    Route::post('lineSearch', 'LinesController@search')->name('line.search');

    Route::get ('newLine', 'LinesController@create')->name('line.create');
    Route::post('newLine', 'LinesController@store')->name('line.save');

    Route::get ('line/{id}', 'LinesController@details')->name('line.details');
    Route::post('line/{id}', 'LinesController@update')->name('line.update');

    Route::get ('lineDestroy/{id}'  , 'LinesController@destroy')->name('line.destroy');
    Route::delete('lineDestroy/{id}', 'LinesController@destroy')->name('line.destroy');
});

// Timetables
Route::group(['middleware' => 'auth'], function() {
    Route::get ('timetables/{line_id}', 'TimetablesController@resume')->name('timetable.details');

    Route::post('newTimetable/{line_id}', 'TimetablesController@store')->name('timetable.store');

    Route::get ('timetableDestroy/{line_id}/{id}'  , 'TimetablesController@destroy')->name('timetable.destroy');
    Route::delete('timetableDestroy/{line_id}/{id}', 'TimetablesController@destroy')->name('timetable.destroy');
    
    //AJAX
    Route::post('timetablesNoService/{route_id}'  , 'TimetablesController@getByRouteNoServices')->name('timetable.serviceTimetables');

});

// Services
Route::group(['middleware' => 'auth'], function() {
    Route::get ('services', 'ServicesController@all')->name('service.resume');

    Route::get ('newService', 'ServicesController@create')->name('service.create');
    Route::post('newService', 'ServicesController@store')->name('service.save');

    Route::get ('service/{service_number}', 'ServicesController@details')->name('service.details');
    Route::post('service/{service_number}', 'ServicesController@update')->name('service.update');

    Route::get ('serviceDestroy/{service_number}'  , 'ServicesController@destroy')->name('service.destroy');
    Route::delete('serviceDestroy/{service_number}', 'ServicesController@destroy')->name('service.destroy');

    Route::post('serviceAddTimetable/{id}', 'ServicesController@addTimetable')->name('service.addTimetable');
    Route::get('serviceDestroyTimetable/{service_id}/{timetable_id}', 'ServicesController@destroyTimetable')->name('service.destroyTimetable');


});