<?php

use Illuminate\Support\Facades\Route;

Route::get('/v1/todos',[App\Http\Controllers\TodoController::class,'index']);
Route::post('/v1/todos',[App\Http\Controllers\TodoController::class,'store']);
Route::patch('/v1/todos/{id}',[App\Http\Controllers\TodoController::class,'update']);
Route::delete('/v1/todos/{id}',[App\Http\Controllers\TodoController::class,'destroy']);
Route::get('/v1/todos/{id}',[App\Http\Controllers\TodoController::class,'show']);
Route::post('/v1/todos/upload',[App\Http\Controllers\TodoController::class,'upload']);
