<?php

use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\HomepageController;
use App\Http\Controllers\Api\ItemsCategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main_pages.welcome_page');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::apiResource('user_register', App\Http\Controllers\Auth\RegisteredUserController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('dahsboard_main', [HomepageController::class, 'index'])->name('dashboard_main');
    Route::get('profile_information', [ProfileController::class, 'user_profile'])->name('profile_information');
    Route::put('profile_update/{id}', [ProfileController::class, 'update'])->name('profile_update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('signout', [AuthenticatedSessionController::class, 'destroy'])->name('signout');

    Route::apiResource('master_customers', App\Http\Controllers\Api\CustomerController::class);

    // Products Route
    Route::apiResource('master_products', App\Http\Controllers\Api\ProductsController::class);
    Route::get('product_create', [ProductsController::class, 'create'])->name('product_create');
    Route::get('product_update/{id}', [ProductsController::class, 'product_update_layout'])->name('product_update');
    Route::put('edit_product/{id}', [ProductsController::class, 'update'])->name('edit_product');
    Route::delete('product_delete/', [ProductsController::class, 'destroy'])->name('product_delete');

    // Routes Category
    Route::apiResource('master_category', App\Http\Controllers\Api\ItemsCategoryController::class);
    Route::get('category_create', [ItemsCategoryController::class, 'category_create'])->name('category_create');
    Route::get('category_update/{id}', [ItemsCategoryController::class, 'category_update'])->name('category_update');
    Route::put('category_edit/{id}', [ItemsCategoryController::class, 'update'])->name('category_edit');

    // Route for Transactions
    Route::apiResource('transaction', App\Http\Controllers\Api\TransactionController::class);
    Route::get('transaction_create', [TransactionController::class, 'transaction_create_layout'])->name('transaction_create');
    Route::get('invoice_detail/{id}', [TransactionController::class, 'invoice'])->name('invoice_detail');

    // Route Shopping Cart 
    Route::post('/cart/add', [ShoppingCartController::class, 'add'])->name('cart_add');
    Route::post('clear_cart', [ShoppingCartController::class, 'clear_cart_session'])->name('clear_cart');
    Route::post('delete_item_cart/{id}', [ShoppingCartController::class, 'delete_cart_product'])->name('delete_item_cart');

    // Route Discount
    Route::apiResource('discount', App\Http\Controllers\Api\DiscountController::class);
    Route::get('discount_create', [DiscountController::class, 'discount_create_layout'])->name('discount_create');
    Route::get('update_discount/{id}', [DiscountController::class, 'edit_layout'])->name('update_discount');
    Route::put('edit_discount/{id}', [DiscountController::class, 'update'])->name('edit_discount');
});

require __DIR__ . '/auth.php';
