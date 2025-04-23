<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;


Route::get('/generate', function () {
    return response()->json([
        'status' => 'Backend is UP',
        'endpoint' => '/api/generate'
    ]);
});

Route::post('/generate-cover-letter', [PDFController::class, 'generateCoverLetter']);
Route::post('/generate', [PDFController::class, 'generate']);
Route::post('/generate-cover-letter-text', [PDFController::class, 'generateCoverLetterText']);

Route::options('/generate', function (Request $request) {
    return response('', 204)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'POST, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});
