<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\UserController;
use App\Models\ad;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::get('/users', [UserController::class, 'index']);
Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}/update-password', [UserController::class, 'updatePassword']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/categories/details',[CategoryController::class,'getAllCategoriesWithDetails']);
Route::get('/categories/{id}',[CategoryController::class,'show']);
Route::get('/subcategories',[SubcategoryController::class,'index']);
Route::post('/subcategories',[SubcategoryController::class,'store']);
Route::get('/products',[ProductController::class,'index']);
Route::post('/products',[ProductController::class,'store']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::get('/products/{userId}/products',[ProductController::class,'getUSerProducts']);
Route::delete('/products/{id}',[ProductController::class,'destroy']);
Route::get('/categories/{catId}/products',[ProductController::class,'getCategoryProducts']);
Route::post('/ads', [AdController::class, 'store']);
Route::get('/ads', [AdController::class, 'index']);
Route::get('/ads/{userId}/ads',[AdController::class,'getUserAds']);
Route::delete('/ads/{id}',[AdController::class,'destroy']);
Route::get('/check-session', function () {
    if (Auth::check()) {
        return response()->json(['status' => 'ok']);
    }
    return response()->json(['status' => 'unauthorized'], 401);
});

