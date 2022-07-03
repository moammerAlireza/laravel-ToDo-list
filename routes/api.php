<?php

use Illuminate\Support\Facades\Route;




Route::group(['prefix'=>'/v1/todos'], function (){
    Route::get('/',[App\Http\Controllers\TodoController::class,'index']);
    Route::post('/',[App\Http\Controllers\TodoController::class,'store']);
    Route::patch('/{todo}',[App\Http\Controllers\TodoController::class,'update']);
    Route::delete('/{todo}',[App\Http\Controllers\TodoController::class,'destroy']);
    Route::get('/{todo}',[App\Http\Controllers\TodoController::class,'show']);
    Route::post('/upload',[App\Http\Controllers\TodoController::class,'upload']);
});
