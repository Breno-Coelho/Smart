<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\MarcaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ROTAS PRODUTOS
Route::get('/get_all_produtos', [ProdutoController::class, 'get_all_produtos']);
Route::get('/search_produtos', [ProdutoController::class, 'search_produtos']);
Route::get('/edit_produto/{id}', [ProdutoController::class, 'edit_produto']);

Route::post('/add_produto', [ProdutoController::class, 'add_produto']);
Route::post('/update_produto/{id}', [ProdutoController::class, 'update_produto']);
Route::get('/delete_produto/{id}', [ProdutoController::class, 'delete_produto']);


// ROTAS MARCAS
Route::get('/marcas', [MarcaController::class, 'all_marcas']);
Route::get('/search_marcas', [MarcaController::class, 'search_marcas']);
Route::get('/edit_marcas/{id}', [MarcaController::class, 'edit_marcas']);

Route::post('/add_marca', [MarcaController::class, 'add_marca']);
Route::post('/update_marca/{id}', [MarcaController::class, 'update_marca']);
Route::get('/delete_marca/{id}', [MarcaController::class, 'delete_marca']);


// Rota para verificar o relacionamento de marca e produto
Route::get('/verifica_produtos_marca/{id}', [ProdutoController::class, 'verifica_produtos_marca']);






