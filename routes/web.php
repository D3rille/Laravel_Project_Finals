<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecordController;


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

//admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get("/userManagement", [AdminController::class, 'index'])->name('admin.userManagement');
    Route::get("/cropManagement", [CropController::class, 'index'])->name('admin.cropManagement');
    Route::post('/admin/user/{id}/change-role', [AdminController::class, 'changeRole'])->name('admin.changeRole');
    // Crop Management
    Route::post('/cropsManagement', [CropController::class, 'store'])->name('crops.store');
    Route::delete('/cropsManagement/{id}', [CropController::class, 'destroy'])->name('crops.destroy');

});

//regular users
Route::middleware(['auth', 'isUser'])->group(function(){
    Route::get('/cropSalesTracker', [ProductController::class, 'index'])->name('salesTracker');
    Route::post('/cropSalesTracker', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/cropSalesTracker/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/cropSalesStatistics', [HomeController::class, 'getSalesStatistics'])->name('salesStatistics');
    Route::get('/cropSalesStatistics/{cropName}/{id}', [HomeController::class, 'getGraph'])->name('graph');
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

