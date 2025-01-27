<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\LocationController;

Route::get('/add-location', function () {
    return view('map.add-location');
});
Route::get('/view-location', function () {
    return view('map.view-location');
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

Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('dashboard');
