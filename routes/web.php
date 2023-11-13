<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankPaymentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PurchaseController;


use App\Http\Controllers\QuotationController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
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

Route::get('/rest',function (){
   \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::get('/', [PageController::class,'login'])->name('login');
Route::get('/register', [PageController::class,'register'])->name('register');
Route::post('/login_submit',[AuthController::class,'login_submit'])->name('login_submit');
Route::post('/register_submit',[AuthController::class,'register_submit'])->name('register_submit');

Route::group(['middleware' =>'auth'], function (){

    Route::get('/home', [PageController::class,'home'])->name('home');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);

    Route::resource('products',ProductController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('institutions',InstitutionController::class);
    Route::resource('warehouses',WarehouseController::class);
    Route::resource('banks',BankController::class);
    Route::resource('incomes',IncomeController::class);
    Route::resource('expenses',ExpenseController::class);
    Route::resource('plans',PlanController::class);
    Route::resource('purchases',PurchaseController::class);
    Route::resource('purchases',PurchaseController::class);
    Route::resource('bank_payments',BankPaymentController::class);
    Route::resource('reports',ReportController::class);

    Route::resource('quotations',QuotationController::class);
    Route::resource('sales',SaleController::class);



    Route::post('/group_payment',[PackageController::class,'group_payment'])->name('group_payment');
    Route::get('/packages',[PackageController::class, 'index'])->name('packages.index');
    Route::delete('/packages/{package}',[PackageController::class, 'destroy'])->name('packages.destroy');
});
