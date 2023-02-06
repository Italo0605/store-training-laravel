<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductsController::class, 'show'])->name('product');

//admin
Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.product');

Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');

Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.product.create');
Route::post('/admin/products/', [AdminProductController::class, 'store'])->name('admin.product.store');
Route::get('/admin/products/{product}/delete', [AdminProductController::class, 'delete'])->name('admin.product.delete');
Route::get('/admin/products/{product}/delete-image', [AdminProductController::class, 'deleteImage'])->name('admin.product.deleteImage');



