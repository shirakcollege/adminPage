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
    return view('dashboard');
})->middleware('auth');



Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//Route::get('system-management/{option}', 'SystemMgmtController@index');

Route::get('/profile', 'ProfileController@index');


Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::resource('employee-management', 'ProductManagementController');
Route::post('employee-management/search', 'ProductManagementController@search')->name('employee-management.search');

Route::resource('system-management/country', 'CountryController');
//Route::post('system-management/country/search', 'CountryController')->name('country.search');

Route::resource('system-management/category', 'CategoryController');
Route::post('system-management/category/search', 'CategoryController@search')->name('category.search');
//Route::post('employee-management', 'ProductManagementController@change');



Route::get('avatars/{name}', 'ProductManagementController@load');