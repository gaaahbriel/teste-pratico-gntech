<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/clima/{cidade}',
 [WeatherController::class, 'index']
 );

Route::get('/', function () {
    return view('welcome');
});
