<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;




Route::group(['prefix'=>'/v1/todos'], function (){
//    if (\Illuminate\Support\Facades\App::isLocale('fa')){
//        Route::get('/',[TodoController::class,'index']);
//    }
    Route::get('/',[TodoController::class,'index']);
    Route::post('/',[TodoController::class,'store']);
    Route::patch('/{todo}',[TodoController::class,'update']);
    Route::delete('/{todo}',[TodoController::class,'destroy']);
    Route::get('/{todo}',[TodoController::class,'show']);
    Route::post('/upload',[TodoController::class,'upload']);
});
