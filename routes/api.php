<?php

use App\Http\Controllers\API\AssetApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RiwayatUserApiController;
use App\Http\Controllers\API\TransaksiApiController;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/aset', [AssetApiController::class, 'getAssets']);

Route::post('/transaksi', [TransaksiApiController::class, 'store']);

Route::get('/transaksi', [RiwayatUserApiController::class, 'showRiwayatUser']);

