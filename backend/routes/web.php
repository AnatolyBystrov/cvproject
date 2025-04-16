<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateController;

Route::post('/api/generate', [GenerateController::class, 'generate']);

