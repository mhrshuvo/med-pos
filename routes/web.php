<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group( function () {
    Route::get('/',[HomeController::class,'home'])->middleware('auth');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('change-status', [HomeController::class, 'statusChange'])->name('change.status');

    //auth routes
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile-update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::get('change-password', [ProfileController::class, 'password'])->name('password');
    Route::post('password-update', [ProfileController::class, 'updatePassword'])->name('password.update');

    //users route
    Route::resource('users', UserController::class);

    //contacts route
    Route::resource('contacts', ContactController::class);
    Route::get('suppliers', [ContactController::class, 'suppliers'])->name('supplier.index');

    //transaction routes
    Route::resource('transactions', TransactionController::class);
    Route::get('expense', [TransactionController::class, 'expense'])->name('expense.index');
    Route::get('income', [TransactionController::class, 'income'])->name('income.index');

    //categories
    Route::resource('categories', CategoryController::class);

    //units
    Route::resource('units', UnitController::class);

    //types
    Route::resource('types', TypeController::class);

    //medicines
    Route::resource('medicines', MedicineController::class);

    //purchase
    Route::resource('purchase', PurchaseController::class);
    Route::get('purchase-approve/{id}', [PurchaseController::class,'approve'])->name('purchase.approve');
    Route::post('invoice-amount', [PurchaseController::class,'payment'])->name('invoice.amount');

    //pos
    Route::resource('pos', PosController::class);
    Route::get('pos/draft/list', [PosController::class,'draftList'])->name('pos.draft');
    Route::post('pos/select-medicine', [PosController::class,'selectMedicine'])->name('select.medicine');
    Route::post('pos/search-medicine', [PosController::class,'searchMedicine'])->name('search.medicine');
    Route::get('pos-approve/{id}', [PosController::class,'approve'])->name('pos.approve');

    //Report
    Route::get('stock', [ReportController::class,'stock'])->name('stock');
    Route::get('stock/batch-wise', [ReportController::class,'batchReport'])->name('stock.batch.wise');
    Route::get('report/invoice', [ReportController::class,'invoiceReport'])->name('invoice.report');
    Route::get('report/purchase', [ReportController::class,'purchaseReport'])->name('purchase.report');

    Route::resource('setting', SettingController::class);
});
