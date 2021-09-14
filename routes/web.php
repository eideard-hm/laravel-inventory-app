<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/', function () {
    return view('welcome');
})->name('main');

// =================== Rutas para producto ====================

Route::get(
    '/products',
    [ProductsController::class, 'getAll']
)->name('products.getAll');

// Ruta para añadir productos
Route::get(
    '/products/add/{id?}',
    [ProductsController::class, 'addProduct']
)->name('add.Products');

//Ruta para salvar
Route::post(
    '/products/add/',
    [ProductsController::class, 'save']
)->name('save.Product');

// Ruta para eliminar productos
Route::get(
    'product/delete/{id}',
    [ProductsController::class, 'delete']
)->name('product.Delete');

//====================== Rutas para Brand =========================

Route::get(
    '/brand',
    [BrandController::class, 'getAll']
)->name('brand.getAll');

// Ruta para añadir productos
Route::get(
    '/brand/add/{id?}',
    [BrandController::class, 'add']
)->name('brand.add');

//Ruta para salvar
Route::post(
    '/brand/add/',
    [BrandController::class, 'save']
)->name('brand.Save');

// Ruta para eliminar
Route::get(
    'brand/delete/{id}',
    [BrandController::class, 'delete']
)->name('brand.Delete');

//====================== Rutas para Categories =========================

Route::get(
    '/categories',
    [CategoryController::class, 'getAll']
)->name('category.getAll');

// Ruta para añadir productos
Route::get(
    '/categories/add/{id?}',
    [CategoryController::class, 'add']
)->name('category.add');

//Ruta para salvar
Route::post(
    '/categories/add',
    [CategoryController::class, 'save']
)->name('category.save');

// Ruta para eliminar
Route::get(
    'categories/delete/{id}',
    [CategoryController::class, 'delete']
)->name('category.delete');

//ruta para detalle de factura
Route::get(
    '/invoices',
    [InvoiceController::class, 'show']
)->name('invoiceDetail.show');

//==================== Rutas de autenticación ============================

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
