<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;


Route::post('/v1/user/register',[AuthController::class,'register'])->middleware(['switch_language'])->name('user.register');
Route::post('/v1/user/login',[AuthController::class,'login'])->middleware(['switch_language'])->name('user.login');

Route::group(['prefix'=>'/v1/user','middleware'=>['auth:sanctum','switch_language'], 'as'=>'user.'], function (){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::group(['prefix'=>'/v1/todos','middleware'=>['auth:sanctum','switch_language'],'as'=>'todos.'], function (){

    Route::get('/',[TodoController::class,'index'])->name('index');
    Route::post('/',[TodoController::class,'store'])->name('store');
    Route::patch('/{todo}',[TodoController::class,'update'])->name('update');
    Route::delete('/{todo}',[TodoController::class,'destroy'])->name('destroy');
    Route::get('/{todo}',[TodoController::class,'show'])->name('show');
    Route::post('/upload',[TodoController::class,'upload'])->name('upload');
});
