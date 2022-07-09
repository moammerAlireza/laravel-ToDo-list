<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;


Route::post('/v1/user/register',[AuthController::class,'register']);
Route::post('/v1/user/login',[AuthController::class,'login']);

Route::group(['prefix'=>'/v1/todos','middleware'=>'auth:api'], function (){

    Route::get('/',[TodoController::class,'index']);
    Route::post('/',[TodoController::class,'store']);
    Route::patch('/{todo}',[TodoController::class,'update']);
    Route::delete('/{todo}',[TodoController::class,'destroy']);
    Route::get('/{todo}',[TodoController::class,'show']);
    Route::post('/upload',[TodoController::class,'upload']);
});
