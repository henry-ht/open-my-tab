<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("login", [AuthController::class, 'login'])->name('api.login');
Route::post("register", [AuthController::class, 'register'])->name('api.register');

Route::group([
    'middleware'    => ['auth:sanctum']
], function (){
    Route::get("category", [CategoryController::class, 'index']);
    Route::get("product", [ProductController::class, 'index']);
    Route::apiResource("rent", RentController::class);
});
