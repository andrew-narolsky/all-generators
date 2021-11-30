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
    return view('welcome');
});

// Auth
Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

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
});
