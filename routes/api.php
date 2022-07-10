<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;


Route::post('/v1/user/register',[AuthController::class,'register'])->middleware(['switch_language']);
Route::post('/v1/user/login',[AuthController::class,'login'])->middleware(['switch_language']);

Route::group(['prefix'=>'/v1/user','middleware'=>['auth:sanctum','switch_language']], function (){
    Route::get('/logout',[AuthController::class,'logout']);
});

Route::group(['prefix'=>'/v1/todos','middleware'=>['auth:sanctum','switch_language']], function (){

    Route::get('/',[TodoController::class,'index']);
    Route::post('/',[TodoController::class,'store']);
    Route::patch('/{todo}',[TodoController::class,'update']);
    Route::delete('/{todo}',[TodoController::class,'destroy']);
    Route::get('/{todo}',[TodoController::class,'show']);
    Route::post('/upload',[TodoController::class,'upload']);
});
