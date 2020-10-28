<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;

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

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->delete('/user/{id}', [UserController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/user/{id}', [UserController::class, 'update']);
Route::middleware('auth:sanctum')->get('/user/{id}', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->post('/user', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->delete('/category/{id}', [CategoryController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/category/{id}', [CategoryController::class, 'update']);
Route::middleware('auth:sanctum')->get('/category/{id}', [CategoryController::class, 'show']);
Route::middleware('auth:sanctum')->post('/category', [CategoryController::class, 'store']);
Route::middleware('auth:sanctum')->get('/category', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->delete('/menu/{id}', [MenuController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/menu/{id}', [MenuController::class, 'update']);
Route::middleware('auth:sanctum')->get('/menu/{id}', [MenuController::class, 'show']);
Route::middleware('auth:sanctum')->post('/menu', [MenuController::class, 'store']);
Route::middleware('auth:sanctum')->get('/menu', [MenuController::class, 'index']);

Route::middleware('auth:sanctum')->post('/order', [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->get('/order', [OrderController::class, 'index']);
