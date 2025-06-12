<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $products = Product::with('categories')->get();
//     return view('welcome', compact('products'));
// });

Route::get('/', function () {
    $products = Product::with('categories')->paginate(10);
    return view('welcome', compact('products'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Product, Variants and Category Routes
Route::get('/manage', function () {
    return view('manage');
})->middleware(['auth', 'verified'])->name('manage');

//Manage Product and variants
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

//Authenticated user Delete a Product
Route::get('product/{product}', [ProductController::class, 'deleteProduct'])->name('products.destroy')->middleware(['auth', 'verified']);


Route::get('addProduct', function () {
    $categories = Category::all();
    return view('addProduct', compact('categories'));
})->middleware(['auth', 'verified'])->name('addProduct');

//Add a Product
Route::post('products.add', [ProductController::class, 'addProduct'])->name('products.add')->middleware(['auth', 'verified']);

//Update a Product
Route::get('updateProduct/{product}', [ProductController::class, 'editProduct'])->name('products.edit')->middleware(['auth', 'verified']);
Route::post('product.update/{product}', [ProductController::class, 'updateProduct'])->name('product.update')->middleware(['auth', 'verified']);

//Manage Categories
Route::get('/categories', function () {
    $categories = Category::all();
    return view('categories', compact('categories'));
})->middleware(['auth', 'verified']);

Route::delete('/categories/{category}', [CategoryController::class, 'destroyCategory'])->name('categories.destroy')->middleware(['auth', 'verified']);

Route::get('/addCategory', function () {
    return view('addCategory');
})->name('addCategory')->middleware(['auth', 'verified']);

Route::get('/editCategory/{category}', [CategoryController::class, 'showCategory'])->name('editCategory')->middleware(['auth', 'verified']);
Route::post('/updateCategory/{category}', [CategoryController::class, 'updateCategory'])->name('updateCategory')->middleware(['auth', 'verified']);
Route::post('/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
