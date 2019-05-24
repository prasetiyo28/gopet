<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

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