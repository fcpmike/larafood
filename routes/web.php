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

Route::prefix('admin')
        ->namespace('Admin')
        ->group(function(){

    /**
     * Routes Permission
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');

    /**
     * Routes Profiles
     */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Routes Details Plan
     */
    Route::delete('plans/{url}/details/{id}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{id}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{id}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{id}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes Plan
     */
    Route::get('/plans/create', 'PlanController@create')->name('plans.create');
    Route::any('/plans/search', 'PlanController@search')->name('plans.search');
    Route::put('/plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('/plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::delete('/plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('/plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('/plans', 'PlanController@store')->name('plans.store');
    Route::get('/plans', 'PlanController@index')->name('plans.index');

    /**
     * Home Dashoboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');
});


Route::get('/', function () {
    return view('welcome');
});
