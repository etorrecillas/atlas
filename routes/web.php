<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Rotas protegidas por senha
Route::middleware('auth')->group(function () {

    //Rotas Perfil
    Route::get('alterar_senha', 'Auth\CustomPasswordController@changePassword')->name('changepass.form');
    Route::post('alterar_senha', 'Auth\CustomPasswordController@saveNewPassword')->name('changepass.form.do');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    //Dashboard
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('ajaxChart', 'DashboardController@ajaxChart')->name('ajaxChart');

    //Rotas Admin
    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('om', 'MilitaryOrganizationController')->parameter('om', 'military_organization');
            Route::resource('usuarios', 'UserController')->parameter('usuarios', 'user');
            Route::post('usuarios/{user}/redefinir_senha', 'UserController@resetPassword')->name('usuarios.resetpass');
            Route::resource('tipos_atividade', 'ActivityTypeController')->parameter('tipos_atividade', 'activity_type');
            Route::get('logs', 'LogController@index')->name('logs.index');
            Route::get('ajax/logs', 'LogController@indexAjax')->name('logs.index.ajax');
            Route::get('integridade', 'IntegrityController@index')->name('integridade.index');
        });

    //Rotas Atividades
    Route::resource('atividades', 'ActivityController')->parameter('atividades', 'activity');

    //Rotas Atividades AJAX
    Route::get('ajax/atividades', 'ActivityController@indexAjax')->name('atividades.index.ajax');


});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

