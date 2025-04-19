<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryAttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TaxesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::prefix('admin')->middleware('admin')->group(function () {
    /** DashBoard */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    /** Profile */
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile', [ProfileController::class, 'store'])->name('admin.profile.store');
    /** Home Banner */
    Route::get('/home_banner', [HomeBannerController::class, 'index'])->name('admin.home.banner');
    Route::post('/home_banner', [HomeBannerController::class, 'store'])->name('admin.home.banner.store');

    /** Size */
    Route::get('/size', [SizeController::class, 'index'])->name('admin.size');
    Route::post('/size', [SizeController::class, 'store'])->name('admin.size.store');

    /** Color */
    Route::get('/color', [ColorController::class, 'index'])->name('admin.color');
    Route::post('/color', [ColorController::class, 'store'])->name('admin.color.store');

    /** Attributes */
    Route::get('/attribute', [AttributeController::class, 'index'])->name('admin.attribute');
    Route::post('/attribute', [AttributeController::class, 'store'])->name('admin.attribute.store');

    /** Attributes Value */
    Route::get('/attribute-value', [AttributeValueController::class, 'index'])->name('admin.attribute.value');
    Route::post('/attribute-value', [AttributeValueController::class, 'store'])->name('admin.attribute.value.store');

    /** Category */
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');

    /** Category Attribute */
    Route::get('/category_attribute', [CategoryAttributeController::class, 'index'])->name('admin.category.attribute');
    Route::post('/category_attribute', [CategoryAttributeController::class, 'store'])->name('admin.category.attribute.store');

    /** Brands */
    Route::get('/brand', [BrandsController::class, 'index'])->name('admin.brand');
    Route::post('/brand', [BrandsController::class, 'store'])->name('admin.brand.store');

    /** Tax */
    Route::get('/tax', [TaxesController::class, 'index'])->name('admin.tax');
    Route::post('/tax', [TaxesController::class, 'store'])->name('admin.tax.store');

    /** Products */
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/new/product/{id}', [ProductController::class, 'add_product'])->name('admin.new.product');
    Route::post('/updateproduct', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('/getAttribute', [ProductController::class, 'getAttribute'])->name('admin.product.getAttribute');
    Route::post('/deleteAttribute', [ProductController::class, 'removeAttribute'])->name('admin.product.deleteAttribute');



    /** Delete*/
    Route::post('/{table}/delete/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.delete');
});

