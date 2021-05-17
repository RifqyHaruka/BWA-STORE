<?php

use App\Http\Controllers\Admin\CategoryControllerr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingsController;
use App\Http\Controllers\Admin\DashboarController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\TransactionController;

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

// Route::get('/', function () {
//     return view('pages/home');
// });

// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('details');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('details-addtocart');


Route::get("/success",[CartController::class,'success'])->name('success');
Route::get('/register/success',[Auth\RegisterController::class,'success']);


Route::post('/checkout/callback',[CheckoutController::class,'callback'])->name('midtranscallback');

//Route yang membutuhkan Login
Route::group(['middleware'=>['auth']], function(){

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{id}',[CartController::class,'delete'])->name('cartdelete');
Route::post('/checkout',[CheckoutController::class,'process'])->name('checkout');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/product',[DashboardProductController::class,'index'])->name('dashboard-product');
Route::get('/dashboard/product/create',[DashboardProductController::class,'create'])->name('create');
Route::post('/dashboard/product/store',[DashboardProductController::class,'store'])->name('store');
Route::get('/dashboard/product/{id}',[DashboardProductController::class,'details'])->name('dashboard-product-details');
Route::post('/dashboard/product/{id}',[DashboardProductController::class,'update'])->name('dashboard-product-update');
Route::post('/dashboard/product/gallery/upload',[DashboardProductController::class,'uploadGallery'])->name('dashboard-product-gallery-upload');
Route::get('/dashboard/product/gallery/delete/{id}',[DashboardProductController::class,'deleteGallery'])->name('dashboard-product-gallery-delete');

Route::get('/dashboard/transaction',[DashboardTransactionController::class,'index'])->name('dashboard-transaction');
Route::get('/dashboard/transaction/{id}',[DashboardTransactionController::class,'details'])->name('dashboard-transaction-details');
Route::post('/dashboard/transaction/{id}',[DashboardTransactionController::class,'update'])->name('dashboard-transaction-update');
Route::get('/dashboard/settings',[DashboardSettingsController::class,'settings'])->name('dashboard-settings-account');
Route::get('/dashboard/account',[DashboardSettingsController::class,'account'])->name('dashboard-account');
Route::post('/dashboard/account/{redirect}',[DashboardSettingsController::class,'update'])->name('dashboard-settings-redirect');



});


//Middleware Auth

Route::prefix('admin')
    ->middleware(['auth','admin'])
    //  ->name("admin-dashboard")
    // ->namespace("App\Http\Controllers\Admin")
    ->group(function(){
        Route::get('/',[DashboarController::class,'index'])->name("admin-dashboard");
        Route::resource('category',\App\Http\Controllers\Admin\CategoryControllerr::class);
        Route::resource('user',UserController::class);
        Route::resource('product',ProductController::class);
        Route::resource('product-gallery',ProductGalleryController::class);
        Route::resource('transaction',TransactionController::class);
    }); //Bisa ngebedain karena diberi prefix admin jadi istilah nya langsung pake /admin,bisa ngebedain dashboard karena dikasin namespace

    
Auth::routes();





