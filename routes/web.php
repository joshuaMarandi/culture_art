<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AuthenticatedSessionController;



// routes/web.php




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


Route::get('/buyer/view_product/{id}', [ProductController::class, 'show'])->name('buyer.view_product');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');


// routes/web.php
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



// Update the logout route to use the custom controller
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

//adding art
Route::get('/art/create', [ProductController::class, 'create'])->name('art.create');
Route::post('/art', [ProductController::class, 'store'])->name('art.store');


// Route for the buyer landing page
Route::get('/buyer/landing', [ProductController::class, 'showBuyerLanding'])->name('buyer.landing');


Auth::routes(); // This registers the login, register, logout, etc.


Route::get('/arts', [ArtController::class, 'index'])->name('arts.index');



// Admin dashboard route
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Ensure logout is handled
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Homepage route for guests
Route::get('/', function () {
    return view('buyer/landing');
});

// In routes/web.php
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route for buyer landing page
Route::get('/buyer/landing', [ArtController::class, 'showBuyerLanding'])->name('buyer.landing');


// routes/web.php

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

