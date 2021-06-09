<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RejectProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/product/paginate', [ProductController::class, 'paginate'])->name('product.paginate');
    Route::get('/product/json', [ProductController::class, 'productAlljson'])->name('product.json');
    Route::post('/product/import', [ProductController::class, 'import'])->name('product.import');
    Route::resource('/product', ProductController::class);

    Route::get('/delivery/paginate', [DeliveryController::class, 'paginate'])->name('delivery.paginate');
    Route::resource('/delivery', DeliveryController::class);

    Route::get('/reject/paginate', [RejectProductController::class, 'paginate'])->name('reject.paginate');
    Route::resource('/reject', RejectProductController::class);

    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/paginate', [StockController::class, 'paginate'])->name('stock.paginate');
    Route::get('/product/stock/export/excel', [StockController::class, 'excel']);
    Route::get('/product/stock/export/pdf', [StockController::class, 'pdf']);

    Route::get('/reject-product-report', [ReportController::class, 'rejectReport']);

    Route::get('/role/paginate', [RoleController::class, 'paginate'])->name('role.paginate');
    Route::resource('/role', RoleController::class);

    Route::get('/user/paginate', [UserController::class, 'paginate'])->name('user.paginate');
    Route::resource('/user', UserController::class);
});
