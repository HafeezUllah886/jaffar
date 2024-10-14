<?php

use App\Http\Controllers\OrdersController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('orders', OrdersController::class);

    Route::get("order/delete/{id}", [OrdersController::class, 'destroy'])->name('order.delete')->middleware(confirmPassword::class);

});
