<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateController;

Route::get('/test-cv', function () {

    Route::get('/', function () {
        return response()->json([
            'status' => 'Backend is up',
            'endpoint' => '/api/generate'
        ]);
    });
    

    return view('pdf.cv', [
        'name' => 'John Doe',
        'position' => 'Developer',
        'experience' => 'Worked at Google',
        'education' => 'BSc Computer Science',
        'skills' => 'Laravel, React, Docker',
        'hobbies' => 'Hiking, Chess',
        'cover_letter' => 'Dear Hiring Manager, I am excited to apply...'
    ]);
});

