<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BooksController;

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

Route::post('product/create',[ProductController::class,'create']);
Route::get('product/list',[ProductController::class,'list']);
Route::get('product/show/{id}',[ProductController::class,'show']);
Route::post('product/update',[ProductController::class,'update']);
Route::post('product/delete',[ProductController::class,'delete']);

Route::post('product/delete',[ProductController::class,'delete']);

// Route::get('book/list',[BooksController::class,'apitest']);
Route::get('book/list',[BooksController::class,'apitest']);



Route::POST('category/show',[CategoryController::class,'show']);
Route::POST('category/store',[CategoryController::class,'store']);