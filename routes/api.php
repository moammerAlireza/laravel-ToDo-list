<?php

use Illuminate\Support\Facades\Route;

Route::get('/v1/todos',[App\Http\Controllers\TodoController::class,'index']);
Route::post('/v1/todos',[App\Http\Controllers\TodoController::class,'store']);
