<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
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

Route::get('/', function () {
    return view('welcome');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\MenuController::class, 'index'])->name('home');
/*------------------------------------------
All Normal Users Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:stuff'])->group(function () {
Route::get('/home', [MenuController::class, 'index'])->name('home');
});
/*------------------------------------------
All Admin Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
Route::get('/admin/items', [MenuController::class, 'filterByCategory'])->name('item.index');
Route::get('/admin/filter', [MenuController::class, 'filterByCategory'])->name('item.filter');
Route::get('/admin/item/create', [MenuController::class, 'create'])->name('item.create');
Route::post('/admin/item/store', [MenuController::class, 'store'])->name('item.store');
Route::get('/admin/item/edit/{id}', [MenuController::class, 'edit'])->name('item.edit');
Route::put('/admin/item/update/{id}', [MenuController::class, 'update'])->name('item.update');
Route::delete('/admin/item/delete/{id}', [MenuController::class, 'destroy'])->name('item.delete');


Route::get('/admin/categories', [CategoryController::class, 'index'])->name('cat.index');
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('cat.create');
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('cat.store');
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('cat.edit');
Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('cat.update');
Route::delete('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('cat.delete');



});
