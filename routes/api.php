<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', PassportAuthController::class . '@register')->name('register');
Route::post('login', PassportAuthController::class . '@login')->name('login');

//listar todas las categorias
Route::get('categories/all',CategoryController::class . '@admin')->name('categories/all');

//obtener una categoria
Route::get('category/id/{id}',CategoryController::class . '@show')->name('category/id');


//crear una categoria
Route::post('category/create',CategoryController::class . '@store')->name('category/create');

//actualizar una categoria
Route::put('category/update/{id}',CategoryController::class . '@update')->name('category/update');

//eliminar una categoria
Route::delete('category/delete/{id}',CategoryController::class . '@destroy')->name('category/delete');


//listar productos
Route::get('products/all',ProductController::class . '@admin')->name('products/all');

//obtener un producto
Route::get('products/id/{id}',ProductController::class . '@show')->name('products/id');

//protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('logout', PassportAuthController::class . '@logout')->name('logout');
});