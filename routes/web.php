<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgingReportController;
use App\Http\Controllers\BalanceSheetController;
use App\Http\Controllers\CashflowReportController;
use App\Http\Controllers\EntityPriceLogController;
use App\Http\Controllers\FinancialActivityController;
use App\Http\Controllers\FinancialEntityController;
use App\Http\Controllers\FixedAssetController;
use App\Http\Controllers\FixedAssetsReportController;
use App\Http\Controllers\ProfitLossStatementController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\TransactionController;

# auth
Auth::routes();
Route::get('/', [TransactionController::class, 'index'])->name('dashboard.index');

# control centre
Route::get('/transaction', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/financial_activity', [FinancialActivityController::class, 'index'])->name('financial_activities.index');
Route::get('/fixed_assets', [FixedAssetController::class, 'index'])->name('fixed_assets.index');
Route::get('/revenue', [RevenueController::class, 'index'])->name('revenues.index');
Route::get('/financial_entity', [FinancialEntityController::class, 'index'])->name('financial_entities.index');
Route::get('/entity_price_log', [EntityPriceLogController::class, 'index'])->name('entity_price_logs.index');

# entity price log
Route::post('/entity_price_log/destroy', [EntityPriceLogController::class, 'destroy'])->name('entity_price_logs.destroy');
Route::get('/entity_price_log/show', [EntityPriceLogController::class, 'show'])->name('entity_price_logs.show');
Route::post('/entity_price_log/store', [EntityPriceLogController::class, 'store'])->name('entity_price_logs.store');
Route::post('/entity_price_log/update', [EntityPriceLogController::class, 'update'])->name('entity_price_logs.update');

# financial activity
Route::post('/financial_activity/destroy', [FinancialActivityController::class, 'destroy'])->name('financial_activities.destroy');
Route::get('/financial_activity/show', [FinancialActivityController::class, 'show'])->name('financial_activities.show');
Route::post('/financial_activity/store', [FinancialActivityController::class, 'store'])->name('financial_activities.store');
Route::post('/financial_activity/update', [FinancialActivityController::class, 'update'])->name('financial_activities.update');

# financial entity
Route::post('/financial_entity/destroy', [FinancialEntityController::class, 'destroy'])->name('financial_entities.destroy');
Route::get('/financial_entity/show', [FinancialEntityController::class, 'show'])->name('financial_entities.show');
Route::post('/financial_entity/store', [FinancialEntityController::class, 'store'])->name('financial_entities.store');
Route::post('/financial_entity/update', [FinancialEntityController::class, 'update'])->name('financial_entities.update');

# fixed assets
Route::post('/fixed_assets/destroy', [FixedAssetController::class, 'destroy'])->name('fixed_assets.destroy');
Route::get('/fixed_assets/show', [FixedAssetController::class, 'show'])->name('fixed_assets.show');
Route::post('/fixed_assets/store', [FixedAssetController::class, 'store'])->name('fixed_assets.store');
Route::post('/fixed_assets/update', [FixedAssetController::class, 'update'])->name('fixed_assets.update');

# revenue
Route::post('/revenue/destroy', [RevenueController::class, 'destroy'])->name('revenues.destroy');
Route::get('/revenue/show', [RevenueController::class, 'show'])->name('revenues.show');
Route::post('/revenue/store', [RevenueController::class, 'store'])->name('revenues.store');
Route::post('/revenue/update', [RevenueController::class, 'update'])->name('revenues.update');

# transaction
Route::post('/transaction/destroy', [TransactionController::class, 'destroy'])->name('transactions.destroy');
Route::get('/transaction/show', [TransactionController::class, 'show'])->name('transactions.show');
Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transactions.store');
Route::post('/transaction/update', [TransactionController::class, 'update'])->name('transactions.update');

# reports
Route::get('/aging_report', [AgingReportController::class, 'index'])->name('aging_reports.index');
Route::get('/balance_sheet', [BalanceSheetController::class, 'index'])->name('balance_sheets.index');
Route::get('/cashflow_report', [CashflowReportController::class, 'index'])->name('cashflow_reports.index');
Route::get('/fixed_assets_report', [FixedAssetsReportController::class, 'index'])->name('fixed_assets_reports.index');
Route::get('/profit_loss_statement', [ProfitLossStatementController::class, 'index'])->name('profit_loss_statements.index');

# error 404
Route::fallback(function () {
    return response()->view('web.errors.404', [], 404);
});
