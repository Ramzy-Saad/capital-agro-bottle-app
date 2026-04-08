<?php

use App\Http\Controllers\BottleController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::resource('bottles', BottleController::class);
    Route::resource('ingredients', IngredientController::class);
});
