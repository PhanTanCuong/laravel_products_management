<?php

use App\Http\Controllers\CalcualtionController;
use App\Http\Controllers\Calculation2ndController;
use App\Http\Controllers\ProductCategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;
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
//     return view('welcome');
// });


// Route::get('/products', [
//     ProductsController::class,
//     'index'
// ]
// );

// Route::get('/products/create', [
//     ProductsController::class,
//     'create'
// ]
// );

// Route::post('/products', [
//     ProductsController::class,
//     'store'
// ]
// );

// Route::get('/products/{id}', [
//     ProductsController::class,
//     'detail'
// ]
// )->where('id','[0-9]+');

//One particular controller
// Route::resource('products',ProductsController::class);


// Product
//List of controllers have same CRUD methods
Route::get('products/search', [ProductsController::class, 'search']);
Route::resources(['products' => ProductsController::class]);

// Product category
Route::resources(['product_categorizes' => ProductCategoryController::class]);


Route::get('/calculation', CalcualtionController::class);
Route::get('/calculation/a', [CalcualtionController::class, 'a']);


Route::get('/calculation2nd', [Calculation2ndController::class]);
Route::get('/calculation2nd/a', [Calculation2ndController::class, 'a']);
Route::get('/calculation2nd/b', [Calculation2ndController::class, 'b']);
Route::get('/calculation2nd/c', [Calculation2ndController::class, 'c']);
