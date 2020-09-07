<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\City;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/cities', 'CityController');
Route::resource('/delivery-times', 'DeliveryTimeController');
Route::post('/cities/{city_id}/delivery-times', 'CityController@attachCityToDeliveryTimes');
Route::post('/cities/{city_id}/delivery-times/exclude-date', 'CityController@ExcludDeliveryTimeOnDateFromCity');
Route::get('/cities/{city_id}/delivery-dates-times/{number_of_days}', 'CityController@displayAvailableDeliveryTimesOnrangDate');



