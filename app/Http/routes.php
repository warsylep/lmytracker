<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 
        [ 'as' => 'home', 'uses' => 'MeasurementController@index' ]);

    Route::get('/dashboard/{user?}', 
        [ 'as' => 'dashboard', 'uses' => 'MeasurementController@dashboard'])
        ->where('user', '\d+');

    Route::get('/chart/{type}/{user?}', 
        [ 'as' => 'measurement.chart', 'uses' => 'MeasurementController@chart'])
        ->where('type', 'weight|bodyfat|tbw|muscle|bone')
        ->where('user', '\d+');

    Route::get('/json/chart/{type}/{user?}', 
        [ 'as' => 'measurement.chart.json', 'uses' => 'MeasurementController@chartJson'])
        ->where('type', 'weight|bodyfat|tbw|muscle|bone')
        ->where('user', '\d+');

    Route::get('/measurement/add', 
        [ 'as' => 'measurement.add', 'uses' => 'MeasurementController@add']);
    Route::post('/measurement/add', 
        [ 'as' => 'measurement.store', 'uses' => 'MeasurementController@store']);

    // delete measurement
    Route::delete('/measurement/{measurement}', 
        [ 'as' => 'measurement.delete', 'uses' => 'MeasurementController@delete'])
        ->where('measurement', '\d+');;

    // Authentication Routes...
    Route::get('/auth/login', 'Auth\AuthController@getLogin');
    Route::post('/auth/login', 'Auth\AuthController@postLogin');
    Route::get('/auth/logout', 'Auth\AuthController@logout');

    // Registration Routes...
    Route::get('/auth/register', 'Auth\AuthController@getRegister');
    Route::post('/auth/register', 'Auth\AuthController@postRegister');

    // Password reset link request routes...
    Route::get('/password/email', 'Auth\PasswordController@getEmail');
    Route::post('/password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('/password/reset', 'Auth\PasswordController@postReset');
});
