<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Conclusion generator
Route::post('/summarize-text',
    [App\Http\Controllers\ConclusionGenerator\ConclusionGeneratorController::class,
        'summarizeText'])->middleware('api-token');
