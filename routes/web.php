<?php

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

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

Route::get('/products/all', function () {
    return response()->json(Product::all());
});

Route::get('/products/{product:id}', function (Product $product) {
    return response()->json($product);
});

Route::get('/transactions/get/{transaction:id}', function (Transaction $transaction) {
    return response()->json($transaction->transactionDetail);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginPage');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

Route::controller(TransactionController::class)->group(function () {
    Route::prefix('/transactions')->group(function () {
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/data', 'data');
        Route::get('/{transaction:id}/edit', 'edit');
        Route::put('/{transaction:id}/update', 'update');
        Route::delete('/{transaction:id}/delete', 'delete');
    });
});
