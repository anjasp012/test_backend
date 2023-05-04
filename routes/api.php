<?php

use App\Http\Controllers\CetakTabunganController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('nasabah', CustomerController::class);
Route::apiResource('transaksi', TransactionController::class);
Route::post('/cetak-tabungan', CetakTabunganController::class);
