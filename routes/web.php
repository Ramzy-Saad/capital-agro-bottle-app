<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeOptionController;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::resource('bottles', BottleController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('attribute-options', AttributeOptionController::class);
});

Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');