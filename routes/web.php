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
    return view('auth.login');
});

Auth::routes();


Route::get('/home', 'HomeController@index');
Route::resource('/applications', 'ApplicationController@index');
Route::get('/application/create', [
    'uses'=>'ApplicationController@create',
    'as'=>'application.create'
]);
Route::post('/application/createNew', [
    'uses'=>'ApplicationController@createNew',
    'as'=>'application.createNew'
]);
Route::post('/application/remark', [
    'uses'=>'ApplicationController@remark',
    'as'=>'application.remark'
]);
Route::group(['prefix' => 'super', 'middleware' => ['auth', 'App\Http\Middleware\SuperUserMiddleware']],
    function (){
        Route::get('/settings', [
            'uses'=>'SettingsController@index',
            'as'=>'settings.index'
        ]);
        Route::post('/settings/update', [
            'uses'=>'SettingsController@update',
            'as'=>'settings.update'
        ]);
    Route::post('/user/save-or-update', 'UserDetailsController@create');
    Route::resource('/users', 'UsersController');
    Route::resource('/user/{id}', 'UserDetailsController');
    Route::post('/user/save/{id}', [
            'uses'=> 'UserDetailsController@store',
            'as'=>'user.save'
        ]);
    Route::post('/user/update/{id}', [
            'uses'=> 'UserDetailsController@update',
            'as'=>'user.update'
        ]);
});
