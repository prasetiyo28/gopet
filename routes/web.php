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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/foods', 'FoodController@index')->name('admin.food');
    Route::get('/foods/create', 'FoodController@create')->name('admin.food.create');
    Route::post('/foods', 'FoodController@store')->name('admin.food.store');
    Route::get('/foods/{id}/edit', 'FoodController@edit')->name('admin.food.edit');
    Route::patch('/foods/{id}', 'FoodController@update')->name('admin.food.update');
    Route::delete('/foods/{id}', 'FoodController@destroy')->name('admin.food.destroy');

    Route::get('/medicine', 'MedicineController@index')->name('admin.medicine');
    Route::get('/medicine/create', 'MedicineController@create')->name('admin.medicine.create');
    Route::post('/medicine', 'MedicineController@store')->name('admin.medicine.store');
    Route::get('/medicine/{id}/edit', 'MedicineController@edit')->name('admin.medicine.edit');
    Route::patch('/medicine/{id}', 'MedicineController@update')->name('admin.medicine.update');
    Route::delete('/medicine/{id}', 'MedicineController@destroy')->name('admin.medicine.destroy');

    Route::get('/washing-and-spa', 'WashingAndSpaController@index')->name('admin.washing-and-spa');
    Route::get('/washing-and-spa/create', 'WashingAndSpaController@create')->name('admin.washing-and-spa.create');
    Route::post('/washing-and-spa', 'WashingAndSpaController@store')->name('admin.washing-and-spa.store');
    Route::get('/washing-and-spa/{id}/edit', 'WashingAndSpaController@edit')->name('admin.washing-and-spa.edit');
    Route::patch('/washing-and-spa/{id}', 'WashingAndSpaController@update')->name('admin.washing-and-spa.update');
    Route::delete('/washing-and-spa/{id}', 'WashingAndSpaController@destroy')->name('admin.washing-and-spa.destroy');

});