<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierController;

Route::get('/add-location', function () {
    $title = 'Add Location';
    return view('map.add-location', compact('title'));
});
Route::get('/view-location', function () {
    $title = 'View Locations';
    return view('map.view-location', compact('title'));
});
Route::get('/table-location', function () {
    $title = 'Table Locations';
    return view('map.table-location', compact('title'));
});
Route::get('/card-location', function () {
    $title = 'Table Locations';
    return view('map.card-location', compact('title'));
});
Route::get('/add-location', [LocationController::class, 'addLocationForm'])->name('add-location');
Route::post('/store-location', [LocationController::class, 'storeLocation'])->name('store-location');
Route::get('/view-map', [LocationController::class, 'viewMap'])->name('view-map');
Route::get('/locations', [LocationController::class, 'getLocations'])->name('get-locations');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/location', [LocationController::class, 'index']);
Route::get('/edit-location/{id}', [LocationController::class, 'edit'])->name('edit-location');
Route::put('/update-location/{id}', [LocationController::class, 'update'])->name('update-location');
Route::delete('/locations/{id}', [LocationController::class, 'destroy']);


Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);

Route::get('/tabel-petani  ', function () {
    $title = 'Table Locations';
    return view('account.tabel-petani', compact('title'));
});

Route::get('/', function () {
    $title = session('title', 'Dashboard'); // Default "Dashboard" jika "title" tidak ada
    return view('home', compact('title'));
})->middleware('auth')->name('dashboard');
