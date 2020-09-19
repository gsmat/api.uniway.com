<?php

use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\UniversityController;
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
Route::prefix('v1')->group(function () {

    Route::prefix('specialization')->group(function () {
        Route::get('/', [SpecializationController::class, 'index'])->name('get.specialization');
        Route::post('store', [SpecializationController::class, 'store'])->name('store.specialization');
    });

    Route::prefix('universities')->group(function () {
        Route::get('/',[UniversityController::class,'index'])->name('get.universities');
        Route::post('store', [UniversityController::class, 'store'])->name('store.university')->middleware('auth');
    });
});
