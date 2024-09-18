<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProductController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use App\Http\Controllers\ArtController;

Route::resource('arts', ArtController::class);



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/buyer/dashboard', [BuyerController::class, 'index'])->name('buyer.dashboard');
});



// Art management routes for sellers
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::resource('arts', ArtController::class);
});


// Art management routes for sellers
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [ArtController::class, 'dashboard'])->name('seller.dashboard');
    Route::resource('arts', ArtController::class)->except(['index']); // Exclude index if you use the dashboard method for listing arts
});

Route::get('/buyer', [ProductController::class, 'showBuyerPage'])->name('buyer.page');

// routes/web.php

// Define the route for the buyer landing page without authentication middleware
Route::get('/buyer/landing', [ArtController::class, 'showBuyerLanding'])->name('buyer.landing');

Route::get('/arts/{id}', [ArtController::class, 'show'])->name('arts.show');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    // Other protected routes
});

// Public route for viewing art details
Route::get('/arts/{id}', [ArtController::class, 'show'])->name('arts.show');



