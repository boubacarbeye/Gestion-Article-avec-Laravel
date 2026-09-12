<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('article')->group(function(){
    Route::get('/',[ArticleController::class,'index'])->name('articles.index');
    Route::get('/create',[ArticleController::class,'create'])->name('articles.create')->middleware('auth');
    Route::post('/create',[ArticleController::class,'store'])->name('articles.store')->middleware('auth');
    Route::get('/edit/{article}',[ArticleController::class,'edit'])->name('articles.edit')->middleware('auth');
    Route::put('/edit/{article}',[ArticleController::class,'update'])->name('articles.update')->middleware('auth');
    Route::delete('/delete/{article}',[ArticleController::class,'delete'])->name('articles.delete')->middleware('auth');
});
Route::prefix('user')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/',[UserController::class,'index'])->name('users.index');
    Route::get('/create',[UserController::class,'create'])->name('users.create');;
    Route::post('/create',[UserController::class,'store'])->name('users.store');
    Route::get('/edit/{user}',[UserController::class,'edit'])->name('users.edit');
    Route::put('/edit/{user}',[UserController::class,'update'])->name('users.update');
    Route::delete('/delete/{user}',[UserController::class,'delete'])->name('users.destroy');;
});
Route::prefix('auth')->group(function(){
    Route::get('/login',[AuthController::class,'form'])->name('login');
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});
