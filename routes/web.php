<?php

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
Route::get('/admin/home', [MenuController::class, 'adminHome'])->name('admin.index')->middleware(['auth', 'user-access:admin']);
Route::get('/admin/item/create', [MenuController::class, 'create'])->name('item.create')->middleware(['auth', 'user-access:admin']);
Route::post('/admin/item/store', [MenuController::class, 'store'])->name('item.store')->middleware(['auth', 'user-access:admin']);
Route::get('/admin/item/edite/{id}', [MenuController::class, 'edit'])->name('item.edit')->middleware(['auth', 'user-access:admin']);
Route::put('/admin/item/update/{id}', [MenuController::class, 'update'])->name('item.update')->middleware(['auth', 'user-access:admin']);
Route::delete('/admin/item/delete/{id}', [MenuController::class, 'destroy'])->name('item.delete')->middleware(['auth', 'user-access:admin']);
});
