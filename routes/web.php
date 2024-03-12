<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('User/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified','is.admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::put('/rate/{id}', [ProductController::class, 'rate'])->name('products.rate');
    Route::post('/comments',[ProductController::class,'comment']);
    Route::post('/phone-finder',[ProductController::class,'phone_finder']);
    Route::get('/phone-finder',[ProductController::class,'get_finder'])->name('products.phone_finder');
    Route::get('/compare/{id}', [ProductController::class,'compare'])->name('products.compare');
});

Route::prefix('news')->group(function(){
    Route::get('/', [NewsController::class, 'index'])->name('news.index');
    Route::get('/show/{news}', [NewsController::class, 'show'])->name('news.show');
});

Route::prefix('reviews')->group(function(){
    Route::get('/', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/show/{review}', [ReviewController::class, 'show'])->name('reviews.show');
});


Route::prefix('admin')->middleware(['auth','is.admin'])->group(function(){

    // admin product routes
    Route::get('/', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // admin news routes
    Route::get('/news', [AdminController::class, 'news'])->name('admin.news');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    // admin reviews routes
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // admin users routes
    Route::get('/users',[AdminController::class,'users'])->name('admin.users');
    Route::get('/users/create',[UserController::class,'create'])->name('users.create');
    Route::post('/users',[UserController::class,'store'])->name('users.store');
    Route::get('/users/{user}',[UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
    Route::delete('/users/{user}',[UserController::class,'delete'])->name('users.delete');

});

require __DIR__.'/auth.php';
