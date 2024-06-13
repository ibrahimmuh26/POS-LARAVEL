<?php

use app\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\ProductActionController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\PosController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;

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
//     return view('login.login');
// });
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'register_action'])->name('register_action');
// Route::post('/', [Controller::class, ''])->name('login');

Route::middleware('auth.web')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [DashboardController::class, 'list_products'])->name('dashboard.products');
    Route::get('/dashboard/products/create', [DashboardController::class, 'create_product'])->name('dashboard.products.create');
    Route::post('/dashboard/products/create', [ProductActionController::class, 'store'])->name('dashboard.products.create.store');
    Route::get('/dashboard/products/edit/{id}', [DashboardController::class, 'edit_product'])->name('dashboard.products.edit');

    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add', [PosController::class, 'addCart'])->name('pos.addCart');
    Route::post('/pos/update/{rowId}', [PosController::class, 'updateCart'])->name('pos.updateCart');
    Route::get('/pos/delete/{rowId}', [PosController::class, 'deleteCart'])->name('pos.deleteCart');
    Route::post('/pos/invoice/create', [PosController::class, 'createInvoice'])->name('pos.createInvoice');
    Route::post('/pos/invoice/print', [PosController::class, 'printInvoice'])->name('pos.printInvoice');

    Route::post('/pos/order', [OrderController::class, 'storeOrder'])->name('pos.storeOrder');
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('order.pendingOrders');
    Route::get('/orders/complete', [OrderController::class, 'completeOrders'])->name('order.completeOrders');
    Route::get('/orders/details/{order_id}', [OrderController::class, 'orderDetails'])->name('order.orderDetails');
    Route::put('/orders/update/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/orders/invoice/download/{order_id}', [OrderController::class, 'invoiceDownload'])->name('order.invoiceDownload');

    // Pending Due
    Route::get('/pending/due', [OrderController::class, 'pendingDue'])->name('order.pendingDue');
    Route::get('/order/due/{id}', [OrderController::class, 'orderDueAjax'])->name('order.orderDueAjax');
    Route::post('/update/due', [OrderController::class, 'updateDue'])->name('order.updateDue');

    // Stock Management
    Route::get('/stock', [OrderController::class, 'stockManage'])->name('order.stockManage');

    Route::resource('/employees', EmployeeController::class);

    Route::resource('/customers', CustomerController::class);

    Route::resource('/suppliers', SupplierController::class);


    Route::get('/products/import', [ProductController::class, 'importView'])->name('products.importView');
    Route::post('/products/import', [ProductController::class, 'importStore'])->name('products.importStore');
    Route::get('/products/export', [ProductController::class, 'exportData'])->name('products.exportData');
    Route::resource('/products', ProductController::class);


    Route::resource('/categories', CategoryController::class);
});
// Route::group(['middleware' => ['auth:sanctum']], function () {
// });
