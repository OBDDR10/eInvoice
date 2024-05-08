<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgingReportController;
use App\Http\Controllers\BalanceSheetController;
use App\Http\Controllers\CashflowReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityPriceLogController;
use App\Http\Controllers\FinancialActivityController;
use App\Http\Controllers\FinancialEntityController;
use App\Http\Controllers\FixedAssetController;
use App\Http\Controllers\FixedAssetsReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfitLossStatementController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\TransactionController;

# auth
Auth::routes();
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

# invoice
Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoice/show', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoice/export', [InvoiceController::class, 'export'])->name('invoices.export');
Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoices.store');
Route::post('/invoice/destroy', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
Route::post('/invoice/send', [InvoiceController::class, 'send'])->name('invoices.send');

# quotation
Route::get('/quotation', [QuotationController::class, 'index'])->name('quotations.index');
Route::get('/quotation/show', [QuotationController::class, 'show'])->name('quotations.show');
Route::get('/quotation/export', [QuotationController::class, 'export'])->name('quotations.export');
Route::post('/quotation/store', [QuotationController::class, 'store'])->name('quotations.store');
Route::post('/quotation/destroy', [QuotationController::class, 'destroy'])->name('quotations.destroy');
Route::post('/quotation/send', [QuotationController::class, 'send'])->name('quotations.send');

# error 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
