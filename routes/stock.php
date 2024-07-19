<?php

use App\Http\Controllers\MaterialStockController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    
    Route::get('material/stock/{id}/{unit}/{from}/{to}', [MaterialStockController::class, 'show'])->name('materialDetails');
    Route::resource('material_stock', MaterialStockController::class);  

    Route::get('products/stock/{id}/{unit}/{from}/{to}', [StockController::class, 'show'])->name('stockDetails');
    Route::resource('product_stock', StockController::class);  
   
});

