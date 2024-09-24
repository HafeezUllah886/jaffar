<?php

use App\Http\Controllers\reports\profitController;
use App\Http\Controllers\reports;
use App\Http\Controllers\reports\productSummaryReport;
use App\Http\Controllers\reports\purchaseGstReportController;
use App\Http\Controllers\reports\salesGstReportController;
use App\Http\Controllers\reports\salesManReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/reports/profit', [profitController::class, 'index'])->name('reportProfit');
    Route::get('/reports/profitData/{from}/{to}', [profitController::class, 'data'])->name('reportProfitData');

    Route::get('/reports/salesman', [salesManReportController::class, 'index'])->name('reportSalesman');
    Route::get('/reports/salesmanData/{id}/{from}/{to}', [salesManReportController::class, 'data'])->name('reportSalesmanData');

    Route::get('/reports/salesGst', [salesGstReportController::class, 'index'])->name('reportSalesGst');
    Route::get('/reports/salesGstData/{from}/{to}', [salesGstReportController::class, 'data'])->name('reportSalesGstData');

    Route::get('/reports/purchasesGst', [purchaseGstReportController::class, 'index'])->name('reportPurchasesGst');
    Route::get('/reports/purchasesGstData/{from}/{to}', [purchaseGstReportController::class, 'data'])->name('reportPurchasesGstData');

    Route::get('/reports/productSummary', [productSummaryReport::class, 'index'])->name('reportProductSummary');
    Route::get('/reports/productSummaryData/{from}/{to}', [productSummaryReport::class, 'data'])->name('reportProductSummaryData');
});
