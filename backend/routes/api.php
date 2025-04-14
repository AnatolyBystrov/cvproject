<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateController;

Route::post('/generate', [GenerateController::class, 'generate']);

use App\Http\Controllers\AiController;

Route::post('/cover-letter', [AiController::class, 'generate']);

