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
Route::delete('/destroy/application', [
    'uses'=>'ApplicationController@destroy',
    'as'=>'app.destroy'
]);
Route::post('/application/district', [
    'uses'=>'ApplicationController@districtChange',
    'as'=>'application.district'
]);
Route::post('application/fetch', 'ApplicationController@fetch')->name('application.fetch');
Route::post('application/deptUsers', 'ApplicationController@deptUsers')->name('application.deptUsers');

Route::post('/application/remark', [
    'uses'=>'ApplicationController@remark',
    'as'=>'application.remark'
]);
Route::post('/application/remark-multiple', [
    'uses'=>'ApplicationController@remarkMultiple',
    'as'=>'application.remarkMultiple'
]);
Route::get('/application/{id}', [
    'uses'=>'ApplicationController@get',
    'as'=>'application.get'
]);
Route::post('/application/save-remark', [
    'uses'=>'ApplicationController@saveRemark',
    'as'=>'application.saveRemark'
]);
Route::post('/application/byDepartment', [
    'uses'=>'ApplicationController@getByDepartment',
    'as'=>'application.getByDepartment'
]);
Route::get('/change-password', [
    'uses'=> 'ChangePasswordController@index',
    'as'=>'change-password.index']);

Route::post('/change-password/change', [
    'uses'=> 'ChangePasswordController@change',
    'as'=>'change-password.change'
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
        Route::post('/settings/url', [
            'uses'=>'SettingsController@url',
            'as'=>'settings.url'
        ]);
        Route::get('/master/{type}', [
            'uses'=>'MasterController@index',
            'as'=>'master.index'
        ]);
        Route::delete('/delete/master', [
            'uses'=>'MasterController@destroy',
            'as'=>'master.destroy'
        ]);

        Route::get('/master/{type}/detail/{id}', [
            'uses'=>'MasterController@getMasterDetails',
            'as'=>'master.details'
        ]);
        Route::post('/master/{type}/create', [
            'uses'=>'MasterController@create',
            'as'=>'master.create'
        ]);
        Route::post('/master/{type}/detail/{id}/update', [
            'uses'=>'MasterController@update',
            'as'=>'master.update'
        ]);
    Route::post('/user/save-or-update', 'UserDetailsController@create');
    Route::resource('/users', 'UsersController');
    Route::get('/user/{id}', 'UserDetailsController@index');
    Route::post('/user/save/{id}', [
            'uses'=> 'UserDetailsController@store',
            'as'=>'user.save'
        ]);
    Route::post('/user/update/{id}', [
            'uses'=> 'UserDetailsController@update',
            'as'=>'user.update'
        ]);
});
