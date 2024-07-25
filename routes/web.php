<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureOrderExistMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

     Route::resource('categories', CategoryController::class);
     Route::resource('products', ProductController::class);
     Route::resource('users', UserController::class);

     Route::get('/orders', [OrderController::class, 'index'])
     ->name('orders.index');
     Route::get('/orders.create', [OrderController::class, 'create'])
     ->name('orders.create');

    Route::middleware(EnsureOrderExistMiddleware::class)->group(function(){
        Route::get('/orders/create/detail/{product}', [OrderController::class, 'createDetail'])
        ->name('orders.create.detail');
        Route::post('/orders/store-detail/{product}', [OrderController::class, 'storeDetail'])
        ->name('orders.storeDetail');
        Route::post('/orders/checkout', [OrderController::class, 'checkout'])
        ->name('orders.checkout');
    });


     Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
     Route::resource('suppliers', SupplierController::class);
     Route::resource('supplier_orders', SupplierOrderController::class);




    // Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Route::get('/categories/create', [CategoryController::class, 'create']);
    // Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    // Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    // Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');





});


