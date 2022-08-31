<?php

use Illuminate\Support\Facades\Route;
use App\Models\Temperature;
use App\Http\Controllers\TemperatureController;

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

//all temperatures from the database
Route::get('/', function () {
    return view('welcome', [
        'temperatures' => Temperature::all(),
    ]);
});

Route::get('/fetch', [TemperatureController::class, 'fetch']);