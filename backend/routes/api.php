<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

Route::post('/generate', [PDFController::class, 'generate']);
