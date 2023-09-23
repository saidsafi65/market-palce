<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('dashboard.parent');
// });

Route::get('/', function () {
    return view('dashboard.pages.index');
});

Route::get('/index', function () {
    return view('dashboard.pages.index');
});

Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/creat',[CategoryController::class,'create'])->name('category.creat');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::put('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');


Route::resource('/product',ProductController::class);