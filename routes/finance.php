<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\authController;
use App\Http\Controllers\DepositWithdrawController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\TransferController;
use App\Http\Middleware\adminCheck;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', adminCheck::class)->group(function () {
    Route::get('account/view/{filter}', [AccountsController::class, 'index'])->name('accountsList');
    Route::get('account/statement/{id}/{from}/{to}', [AccountsController::class, 'show'])->name('accountStatement');
    Route::resource('account', AccountsController::class);

    Route::resource('deposit_withdraw', DepositWithdrawController::class);
    Route::get('depositwithdraw/delete/{ref}', [DepositWithdrawController::class, 'delete'])->name('deposit_withdraw.delete')->middleware(confirmPassword::class);

    Route::resource('transfers', TransferController::class);
    Route::get('transfer/delete/{ref}', [TransferController::class, 'delete'])->name('transfers.delete')->middleware(confirmPassword::class);

    Route::resource('expenses', ExpensesController::class);
    Route::get('expense/delete/{ref}', [ExpensesController::class, 'delete'])->name('expense.delete')->middleware(confirmPassword::class);
});

