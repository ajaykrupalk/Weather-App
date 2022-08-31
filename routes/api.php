<?php

use App\Models\Temperature;
use Zttp\Zttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/location',function(){

    $response = Http::get("http://www.geoplugin.net/json.gp?ip=xx.xx.xx.xx");

    return $response->json();

});

Route::get('/weather',function(){

    $apiKey = 'f92d3f9b489e383709de5eefbd3d9f59';
    $lat = request('lat');
    $lng = request('lon');

    $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?lat=$lat&lon=$lng&units=metric&appid=$apiKey");
    // $response = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lng&units=metric&appid=$apiKey");

    return $response->json();
});

Route::get('/days', function(){
    return Temperature::all();
});