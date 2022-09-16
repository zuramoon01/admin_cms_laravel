<?php

use App\Models\Menu;
use App\Models\Role;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Authorization;
use App\Models\AuthorizationType;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/all', function () {
    return response()->json(Product::all());
});

Route::get('/products/{product:id}', function (Product $product) {
    return response()->json($product);
});

Route::get('/transaction-details/{transaction:id}', function (Transaction $transaction) {
    return response()->json($transaction->transactionDetail);
});

Route::get('/vouchers/all', function () {
    return response()->json(Voucher::all());
});

Route::get('/voucher-usages/{transaction:id}', function (Transaction $transaction) {
    return response()->json($transaction->voucherUsage);
});

Route::get('/authorizations/{role:id}', function (Role $role) {
    $otorisasi = Authorization::where('role_id', $role->id)->get();

    return response()->json(
        view('layouts.authorization.table', [
            'table' => [
                'title' => [
                    'Menu',
                    'View',
                    'Add',
                    'Edit',
                    'Delete',
                ],
                'size' => [6, 1.5, 1.5, 1.5, 1.5],
                'roles' => Role::all(),
                'menus' => Menu::all(),
                'authorization_types' => AuthorizationType::all(),
                'authorizations' => $otorisasi
            ],
        ])->render()
    );

    return response(view('layouts.authorization.table', [
        'table' => [
            'title' => [
                'Menu',
                'View',
                'Add',
                'Edit',
                'Delete',
            ],
            'size' => [6, 1.5, 1.5, 1.5, 1.5],
            'roles' => Role::all(),
            'menus' => Menu::all(),
            'authorization_types' => AuthorizationType::all(),
            'authorizations' => $otorisasi
        ],
    ]));
});
