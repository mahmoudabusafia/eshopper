<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

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


// Dashboard Route
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('admin')->as('admin.')->group(function () {
    require __DIR__.'/auth.php';
    Route::get('test', [AuthenticatedSessionController::class, 'delete'])
        ->name('log');
});


Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/', function () { return view('admin.layouts.starter'); })->name('admin.index');

    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);
    Route::post('products/del-variant', [ProductController::class, 'deleteVariant'])->name('deleteVariant');
    Route::post('products/add-variant', [ProductController::class, 'addVariant'])->name('addVariant');

    Route::resource('roles', RolesController::class);

    Route::resource('roleUser', RoleUserController::class);

    Route::resource('orders', OrderController::class);
    Route::post('orders/status-update', [OrderController::class, 'status_update'])->name('orders.status-update');

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'store']);

});

// WebSite Route

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop-category/{page}', [HomeController::class, 'page'])->name('shop.page');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('product-detail/{id}', [HomeController::class, 'show'])->name('product.details');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store']);
Route::post('/cart/qty', [CartController::class, 'qty'])->name('change.qty');
Route::delete('/cart/{cart}/delete', [CartController::class, 'destroy'])->name('cart.delete');

Route::middleware('auth')->group(function (){

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);
});



Route::get('/orders', function(){
    return Order::all();
})->name('orders');

