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
        [ 'as' => 'dashboard', 'uses' => 'MeasurementController@dashboard']);

    Route::get('/chart/{type}', 
        [ 'as' => 'chart', 'uses' =>  'MeasurementController@chart'])
        ->where('type', 'weight|bodyfat|tbw|muscle|bone');

    Route::get('/chart/{user}/{type}', 
        [ 'as' => 'chart-other', 'uses' =>  'MeasurementController@chart'])
        ->where('type', 'weight|bodyfat|tbw|muscle|bone')
        ->where('user', '\d+');

    //Route::get('/chart/{type}/{user}', 'MeasurementController@dashboardOther');

    Route::get('/json/chart/{type}.json', 
        [ 'as' => 'chartjson', 'uses' =>  'MeasurementController@chartJson'])
        ->where('type', 'weight|bodyfat|tbw|muscle|bone');

    Route::get('/json/chart/{user}/{type}.json', 
        [ 'as' => 'chartjson-other', 'uses' =>  'MeasurementController@chartJson'])
        ->where('type', 'weight|bodyfat|tbw|muscle|bone')
        ->where('user', '\d+');

    Route::get('/measurement/add', 
        [ 'as' => 'add', 'uses' =>  'MeasurementController@add']);
    Route::post('/measurement/add', 
        [ 'as' => 'store', 'uses' => 'MeasurementController@store']);
    Route::delete('/measurement/{measurement}', 
        [ 'as' => 'destroy', 'uses' => 'MeasurementController@destroy']);

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
