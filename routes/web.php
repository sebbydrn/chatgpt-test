<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadQuestionController;
use App\Http\Controllers\ProcessQuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('upload-question', [UploadQuestionController::class, 'index']);
Route::get('process-question', [ProcessQuestionController::class, 'index']);