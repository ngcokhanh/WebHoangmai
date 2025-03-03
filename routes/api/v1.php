<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BannerController;
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

route::apiResource('banners', BannerController::class);
route::apiResource('categories', CategoryController::class);
route::apiResource('users', UserController::class);

route::post('login', [AuthController::class, 'login']);
route::post('register', [AuthController::class, 'register']);
route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

