<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
    Route::get('profile', [ProfileController::class, 'index']);

    Route::get("category", [CategoryController::class, 'index']);

    Route::apiResource("product", ProductController::class);
    Route::get("product/restore/{product}", [ProductController::class, 'restore'], ['parameters' => [
        'product' => 'product',
    ]])->withTrashed();

    Route::apiResource("rent", RentController::class);
});
