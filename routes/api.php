<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('item', 'Api\ItemController@index');
Route::get('item/{id}', 'Api\ItemController@show');

Route::get('foods', 'Api\FoodController@index');
Route::get('foods/{id}', 'Api\FoodController@show');
Route::post('foods', 'Api\FoodController@store');
Route::post('foods/{id}', 'Api\FoodController@update');
Route::delete('foods/{id}', 'Api\FoodController@destroy');


Route::get('medicine', 'Api\MedicineController@index');
Route::get('medicine/{id}', 'Api\MedicineController@show');
Route::post('medicine', 'Api\MedicineController@store');
Route::post('medicine/{id}', 'Api\MedicineController@update');
Route::delete('medicine/{id}', 'Api\MedicineController@destroy');

Route::get('washing-and-spa', 'Api\WashingAndSpaController@index');
Route::get('washing-and-spa/{id}', 'Api\WashingAndSpaController@show');
Route::post('washing-and-spa', 'Api\WashingAndSpaController@store');
Route::post('washing-and-spa/{id}', 'Api\WashingAndSpaController@update');
Route::delete('washing-and-spa/{id}', 'Api\WashingAndSpaController@destroy');

Route::get('buying-animal', 'Api\BuyingAnimalController@index');
Route::get('buying-animal/{id}', 'Api\BuyingAnimalController@show');
Route::post('buying-animal', 'Api\BuyingAnimalController@store');
Route::post('buying-animal/{id}', 'Api\BuyingAnimalController@update');
Route::delete('buying-animal/{id}', 'Api\BuyingAnimalController@destroy');

Route::get('petshop', 'Api\PetShopController@index');
Route::get('petshop/{id}', 'Api\PetShopController@show');
Route::post('petshop', 'Api\PetShopController@store');
Route::post('petshop/{id}', 'Api\PetShopController@update');
Route::delete('petshop/{id}', 'Api\PetShopController@destroy');

Route::get('community', 'Api\CommunityController@index');
Route::get('community/{id}', 'Api\CommunityController@show');

Route::get('doctor', 'Api\DoctorController@index');
Route::get('doctor/{id}', 'Api\DoctorController@show');

// Route for all history for each user.
Route::get('history/{user_id}', 'Api\DiagnosisController@showByUser');

// Route get order history for each user
Route::get('user/order/history', 'Api\UserPetshopController@history');

// route for register user
Route::post('user/register', 'Api\RegisterController@store');
// route for login user
Route::post('user/login', 'Api\LoginController@store');

Route::post('user/order', 'Api\UserPetshopController@store');