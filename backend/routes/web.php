<?php

use App\Http\Controllers\AiController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/ai', [AiController::class, 'generate']);
