<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClimaController;

Route::apiResource('climas', ClimaController::class);