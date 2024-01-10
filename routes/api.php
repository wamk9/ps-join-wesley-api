<?php

use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
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

Route::controller(ProdutoController::class)->group(function(){
    Route::post('/produto', 'create');
    Route::put('/produto/{id}', 'update');
    Route::get('/produto/{id}', 'show');
    Route::delete('/produto/{id}', 'delete');

    Route::get('/produto', 'showList');
});

Route::controller(CategoriaProdutoController::class)->group(function(){
    Route::post('/categoria-produto', 'create');
    Route::put('/categoria-produto/{id}', 'update');
    Route::get('/categoria-produto/{id}', 'show');
    Route::delete('/categoria-produto/{id}', 'delete');

    Route::get('/categoria-produto', 'showList');
});
