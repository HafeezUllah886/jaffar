<?php

use App\Http\Controllers\reports\profitController;
use App\Http\Controllers\reports;
use App\Http\Controllers\reports\salesManReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/reports/profit', [profitController::class, 'index'])->name('reportProfit');
    Route::get('/reports/profitData/{from}/{to}', [profitController::class, 'data'])->name('reportProfitData');

    Route::get('/reports/salesman', [salesManReportController::class, 'index'])->name('reportSalesman');
    Route::get('/reports/salesmanData/{id}/{from}/{to}', [salesManReportController::class, 'data'])->name('reportSalesmanData');
});
