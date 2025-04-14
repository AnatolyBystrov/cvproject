<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateController;

Route::post('/generate', [GenerateController::class, 'generate']);
