<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::apiResource('tests', TestController::class);