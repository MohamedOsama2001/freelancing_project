<?php

use App\Http\Controllers\admin\MaincategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[WelcomeController::class,'welcome'])->name('welcome');
Route::get('/admin',function(){
    return view('admin.index');
});
Route::get('/register',[AuthController::class,'register'])->name("register");
Route::get('/login',[AuthController::class,'login'])->name("login");
Route::post('/register',[AuthController::class,'registerStore'])->name('register.store');
Route::post('/login',[AuthController::class,'loginStore'])->name('login.store');
Route::get('/admin/maincategories',[MaincategoryController::class,'index'])->name('admin.maincategories.index');
Route::get('/admin/maincategories/create',[MaincategoryController::class,'create'])->name('admin.maincategories.create');
Route::post('/admin/maincategories',[MaincategoryController::class,'store'])->name('admin.maincategories.store');
