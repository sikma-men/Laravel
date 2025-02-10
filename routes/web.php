<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BuyerController;

// ================== Dashboard ==================
Route::get('/', function () {
    $title = session('title', 'Dashboard'); // Default "Dashboard" jika "title" tidak ada
    return view('home', compact('title'));
})->middleware('auth')->name('dashboard');

// ================== Authentication ==================
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ================== Map / Location Routes ==================
Route::get('/add-location', [LocationController::class, 'addLocationForm'])->name('add-location');
Route::post('/store-location', [LocationController::class, 'storeLocation'])->name('store-location');
Route::get('/view-map', [LocationController::class, 'viewMap'])->name('view-map');
Route::get('/locations', [LocationController::class, 'getLocations'])->name('get-locations');
Route::get('/location', [LocationController::class, 'index']);
Route::get('/edit-location/{id}', [LocationController::class, 'edit'])->name('edit-location');
Route::put('/update-location/{id}', [LocationController::class, 'update'])->name('update-location');
Route::delete('/locations/{id}', [LocationController::class, 'destroy']);

// ================== Supplier Routes ==================
Route::post('login-supplier', [SupplierController::class, 'login']);
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);
Route::post('/update', [SupplierController::class, 'update'])->name('update');
Route::get('/table-supplier', [SupplierController::class, 'table_supplier'])->name('table-supplier');
Route::get('/add-supplier', function () {
    return view('account.add-supplier');
});

// ================== Buyer Routes ==================
Route::get('/table-buyer', [BuyerController::class, 'table_buyer'])->name('table-buyer');
Route::get('/add-buyer', [BuyerController::class, 'add_buyer'])->name('add-buyer');
Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers');
Route::post('/buyers', [BuyerController::class, 'store'])->name('store-buyer');
// Route::put('/buyers/{id}', [BuyerController::class, 'update'])->name('update-buyer');
Route::delete('/buyers/{id}', [BuyerController::class, 'destroy']);
