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
    [App\Http\Controllers\ConclusionGenerator\ConclusionGeneratorController::class, 'getResultText'])->middleware('api-token');
Route::post('/get-conclusion-generator-stars',
    [App\Http\Controllers\ConclusionGenerator\ConclusionGeneratorController::class, 'getPageStars'])->middleware('api-token');
Route::post('/set-conclusion-generator-stars',
    [App\Http\Controllers\ConclusionGenerator\ConclusionGeneratorController::class, 'setPageStars'])->middleware('api-token');
// Paraphrasing tool
Route::post('/paraphrasing-text',
    [App\Http\Controllers\ParaphrasingTool\ParaphrasingToolController::class, 'getResultText'])->middleware('api-token');
Route::post('/get-paraphrasing-tool-stars',
    [App\Http\Controllers\ParaphrasingTool\ParaphrasingToolController::class, 'getPageStars'])->middleware('api-token');
Route::post('/set-paraphrasing-tool-stars',
    [App\Http\Controllers\ParaphrasingTool\ParaphrasingToolController::class, 'setPageStars'])->middleware('api-token');
// Essay maker
Route::post('/essay-maker',
    [App\Http\Controllers\EssayMaker\EssayMakerController::class, 'getResultText'])->middleware('api-token');
Route::post('/get-essay-maker-stars',
    [App\Http\Controllers\EssayMaker\EssayMakerController::class, 'getPageStars'])->middleware('api-token');
Route::post('/set-essay-maker-stars',
    [App\Http\Controllers\EssayMaker\EssayMakerController::class, 'setPageStars'])->middleware('api-token');

// Save document
Route::post('/get-word-document-link', [App\Http\Controllers\DocumentController::class, 'getWordDocumentLink'])->middleware('api-token');
Route::post('/get-pdf-document-link', [App\Http\Controllers\DocumentController::class, 'getPdfDocumentLink'])->middleware('api-token');
