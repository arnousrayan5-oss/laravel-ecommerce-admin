<?php

use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/product/{product}', [MainController::class, 'showProduct'])->name('product.show');
Route::get('/products', [MainController::class, 'allProducts'])->name('product.all');
Route::get('/products/{tag}', [MainController::class, 'filterByTag'])->name('product.filter');
Route::get('/products/search/{keyword}', [MainController::class, 'searchProduct'])->name('product.search');
Route::post('/addToCart/{product}', [CartController::class, 'addToCart'])->middleware('can:addToCart,product')->name('cart.add');
Route::get('/cartPage', [CartController::class, 'cartPage'])->name('cart.all');
Route::post('/cart/increment/{product}', [CartController::class, 'incrementCart'])->name('cart.increment');
Route::post('/cart/decrement/{product}', [CartController::class, 'decrementCart'])->name('cart.decrement');
Route::post('/cart/remove/{product}', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/order', [CartController::class, 'order'])->name('cart.order');


//Guest Routes
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginAction');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('registerAction');
});

// User Routes
Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/main', [AdminController::class, 'main'])->name('admin.home');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/user/role/{user}/toggle', [AdminController::class, 'toggleRole'])->name('admin.toggleRole');
    Route::post('/admin/user/delete/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/users/deleted', [AdminController::class, 'deletedUsers'])->name('admin.deletedUsers');
    Route::post('/admin/user/restore/{user}', [AdminController::class, 'restoreUser'])->name('admin.restoreUser');
    Route::post('/admin/user/force/{user}', [AdminController::class, 'forceDeleteUser'])->name('admin.forceDeleteUser');
    Route::get('/admin/users/all', [AdminController::class, 'allUsers'])->name('admin.allUsers');
    Route::get('/admin/carousel', [AdminController::class, 'carouselPage'])->name('admin.carousel');
    Route::post('/admin/carousel', [AdminController::class, 'carouselUpload'])->name('admin.carouselUpload');
    Route::get('/admin/tags', [AdminController::class, 'tags'])->name('admin.tags');
    Route::post('/admin/tags', [AdminController::class, 'tagCreate'])->name('admin.tagCreate');
    Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
    Route::post('/admin/products', [ProductController::class, 'create'])->name('admin.productCreate');
    Route::get('/admin/product/edit/{product}', [ProductController::class, 'editPage'])->name('admin.editProduct');
    Route::post('/admin/product/edit/{product}', [ProductController::class, 'edit'])->name('admin.productEditAction');
    Route::post('/admin/product/tag/add/{product}', [ProductController::class, 'addProductTag'])->name('admin.productAddTag');
    Route::post('/admin/product/tag/remove/{product}/{tag}', [ProductController::class, 'removeProductTag'])->name('admin.productRemoveTag');
    Route::post('/admin/product/image/upload/{product}', [ProductController::class, 'uploadProductImage'])->name('admin.productUploadImage');
});

