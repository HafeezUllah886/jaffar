<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RawUnitsController;
use App\Http\Controllers\RecipeManagementController;
use App\Http\Controllers\UnitsController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/finance.php';
require __DIR__ . '/purchase.php';
require __DIR__ . '/stock.php';
require __DIR__ . '/production.php';
require __DIR__ . '/sale.php';

Route::middleware('auth')->group(function () {

    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

    Route::resource('units', UnitsController::class);
    Route::resource('rawunits', RawUnitsController::class);
    Route::resource('material', MaterialController::class);
    Route::resource('product', ProductsController::class);
    Route::resource('ingredient', RecipeManagementController::class);
    Route::get('ingredients/destroy/{productID}/{id}', [RecipeManagementController::class, 'destroy'])
    ->name('ingredient.destroy')->middleware(confirmPassword::class);
});


