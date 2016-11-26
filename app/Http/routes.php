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
Route::auth();
// Authentication routes...

/*Route::get ('login', 'Auth\AuthController@getLogin')->name('login');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get ('logout', 'Auth\AuthController@getLogout')->name('logout');

Route::post ('password/email', 'Auth\PasswordController@postEmail')->name('passwordEmail');

// Password reset routes...
Route::get ('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('passwordReset');*/

// Drivers
Route::group(['middleware' => 'auth'], function() {

    Route::get('user',      'UserProfileController@resume')->name('user_profile.resume');
	Route::get('userImage', 'UserProfileController@getProfileImage')->name('user_profile.image');
    Route::post('user',     'UserProfileController@update')->name('user_profile.update');

	Route::post('changePassword', 'UserProfileController@changePassword')->name('user_profile.changePassword');

});

// Ajax
Route::group(['middleware' => 'auth'], function() {
    Route::get ('ajax/drivers' , 'DriversController@ajaxResume')->name('driver.ajaxResume');
    Route::get ('ajax/buses'   , 'BusesController@ajaxResume')  ->name('bus.ajaxResume');
    Route::get ('ajax/lines'   , 'LinesController@ajaxResume')  ->name('line.ajaxResume');
	Route::get ('ajax/users'   , 'UserController@ajaxResume')   ->name('user.ajaxResume');
	Route::get ('ajax/offWorks', 'OffWorkController@ajaxResume')->name('offWork.ajaxResume');
	Route::get ('ajax/festives', 'FestiveController@ajaxResume')->name('festive.ajaxResume');

});

// Drivers
Route::group(['middleware' => 'auth'], function() {

    // INDEX
    Route::get ('/', 'DriversController@resume')->name('home');

    Route::get ('drivers', 'DriversController@resume')->name('driver.resume');

    Route::get ('newDriver', 'DriversController@create')->name('driver.create');
    Route::post('newDriver', 'DriversController@store')->name('driver.save');

    Route::get ('driver/{id}', 'DriversController@details')->name('driver.details');
    Route::post('driver/{id}', 'DriversController@update')->name('driver.update');

    Route::get ('driverDestroy/{id}', 'DriversController@destroy')->name('driver.destroy');
    Route::delete ('driverDestroy/{id}', 'DriversController@destroy')->name('driver.destroy');

});

// OffWork
Route::group(['middleware' => 'auth'], function() {

	// INDEX
	Route::get ('offwork', 'OffWorkController@resume')->name('offWork.resume');

	Route::post('newDriverOffWork', 'OffWorkController@store')->name('offWork.save');

	Route::get ('offWorkDestroy/{id}', 'OffWorkController@destroy')->name('offWork.destroy');
	Route::delete ('offWorkDestroy/{id}', 'OffWorkController@destroy')->name('offWork.destroy');

});

//Pairs
Route::group(['middleware' => 'auth'], function() {

    Route::get ('pairs', 'PairsController@resume')->name('pair.resume');

	Route::get ('newPair', 'PairsController@create')->name('pair.create');

	Route::get ('pair/{pairNumber}', 'PairsController@details')->name('pair.details');

	Route::get ('pairDestroy/{pairNumber}', 'PairsController@destroy')->name('pair.destroy');
	Route::delete('pairDestroy/{pairNumber}', 'PairsController@destroy')->name('pair.destroy');

	Route::post('pairDriverAdd/{pairNumber}', 'PairsController@driverAdd')->name('pair.driverAdd');
	Route::delete('pairDriverDestroy/{pairNumber}/{driverId}', 'PairsController@driverDestroy')->name('pair.driverDestroy');
});

// Buses
Route::group(['middleware' => 'auth'], function() {

    Route::get ('buses', 'BusesController@resume')->name('bus.resume');

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
    Route::get ('services/{period_id}' , 'ServicesController@all')->name('service.resume');

    Route::get ('newService', 'ServicesController@create')->name('service.create');
    Route::post('newService', 'ServicesController@store')->name('service.save');

    Route::get ('service/{serviceId}', 'ServicesController@details')->name('service.details');
    Route::post('service/{serviceId}', 'ServicesController@update')->name('service.update');

    Route::get ('serviceDestroy/{serviceId}'  , 'ServicesController@destroy')->name('service.destroy');
    Route::delete('serviceDestroy/{serviceId}', 'ServicesController@destroy')->name('service.destroy');

    Route::post('serviceAddTimetable/{id}', 'ServicesController@addTimetable')->name('service.addTimetable');
    Route::get('serviceDestroyTimetable/{service_id}/{timetable_id}', 'ServicesController@destroyTimetable')->name('service.destroyTimetable');

	Route::get ('printServices/{period_id}' , 'ServicesController@printServices')->name('service.print');

});

Route::group(['middleware' => 'auth'], function() {
    Route::get ('cuadrantesJob' , 'CuadrantesController@complexAlgorithm')->name('cuadrantes.complex');

	Route::get ('cuadrantes', 'CuadrantesViewController@allToday')->name('cuadrantes.resume');
	Route::post('cuadrantes', 'CuadrantesViewController@all')->name('cuadrantes.resumePost');
});

// Users
Route::group(['middleware' => 'auth', 'admin'], function() {

	Route::get('users', 'UserController@resume')->name('users.resume');

	Route::get ('newUser', 'UserController@create')->name('user.create');
	Route::post('newUser', 'UserController@store')->name('user.store');

	Route::get ('users/{id}', 'UserController@details')->name('user.details');
	Route::post('users/{id}', 'UserController@update')->name('user.update');

	Route::get ('userDelete/{id}', 'UserController@delete')->name('user.delete');
	Route::delete('userDelete/{id}', 'UserController@delete')->name('user.delete');

});

// Festives
Route::group(['middleware' => 'auth'], function() {

	// INDEX
	Route::get ('festives', 'FestiveController@resume')->name('festive.resume');

	Route::post('newFestive', 'FestiveController@store')->name('festive.save');

	Route::get ('festiveDestroy/{id}', 'FestiveController@destroy')->name('festive.destroy');
	Route::delete ('festiveDestroy/{id}', 'FestiveController@destroy')->name('festive.destroy');

});