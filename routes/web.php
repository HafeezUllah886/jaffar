<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UnitsController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/finance.php';
require __DIR__ . '/purchase.php';
require __DIR__ . '/stock.php';
require __DIR__ . '/sale.php';

Route::middleware('auth')->group(function () {

    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

    Route::resource('units', UnitsController::class);

    Route::resource('product', ProductsController::class);
   
});


