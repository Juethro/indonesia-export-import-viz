<?php

use App\Http\Controllers\query_handler;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/data/chart_1/{jenis}/{tahun}', [query_handler::class, 'chart_1_get']);
Route::get('/data/chart_2/{jenis}/{tahun}', [query_handler::class, 'chart_2_get']);
Route::get('/data/chart_3/{jenis}/{tahun}', [query_handler::class, 'chart_3_get']);
Route::get('/data/chart_4/{jenis}/{tahun}', [query_handler::class, 'chart_4_get']);

