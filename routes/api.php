<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [UserController::class, 'register'])->name('user.register');
    Route::get('/search', [UserController::class, 'search']);
});
Route::prefix('company')->group(function () {
    Route::post('/register', [CompanyController::class, 'register']);
});
Route::prefix('vacancy')->group(function () {
    Route::post('/register', [VacancyController::class, 'register']);
    Route::get('/{id}', [VacancyController::class, 'show']);
});
Route::prefix('application')->group(function () {
    Route::post('/register', [ApplicationController::class, 'register']);
});