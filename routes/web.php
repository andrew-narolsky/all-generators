<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// need change
Route::get('/', function () {
    return view('welcome')->name('home');
});

// Auth
Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

// Conclusion generator
Route::post('/summarize-text', [App\Http\Controllers\ConclusionGenerator\ConclusionGeneratorController::class, 'summarizeText']);
Route::post('/add-vote', [App\Http\Controllers\Admin\PageController::class, 'addVote']);

// Admin
Route::group([
    'prefix'=>'admin',
    'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin');

    Route::group(['prefix' => 'conclusion-generator'], function ()
    {
        Route::get('', [App\Http\Controllers\Admin\ConclusionGeneratorController::class, 'index'])->name('admin.conclusion-generator.index');
        Route::get('{id}', [App\Http\Controllers\Admin\ConclusionGeneratorController::class, 'show'])->name('admin.conclusion-generator.show');
    });

    Route::resource('/pages', App\Http\Controllers\Admin\PageController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('/templates', App\Http\Controllers\Admin\TemplateController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);

    Route::post('/add-block', [App\Http\Controllers\Admin\TemplateController::class, 'addBlock']);
    Route::post('/delete-block', [App\Http\Controllers\Admin\TemplateController::class, 'deleteBlock']);

    Route::resource('/settings', App\Http\Controllers\Admin\SettingsController::class, ['only' => ['index','store']]);
});

// Pages
Route::get('/{pages}', [App\Http\Controllers\PageController::class, 'index'])->name('page');
