<?php

use App\Http\Controllers\ProductionController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('getIngredients/{id}', [ProductionController::class, 'getIngredients'])->name('product.ingredients');
    Route::resource('production', ProductionController::class);
    Route::get('productions/delete/{id}', [ProductionController::class, 'destroy'])
    ->name("production.delete")->middleware(confirmPassword::class);


});
