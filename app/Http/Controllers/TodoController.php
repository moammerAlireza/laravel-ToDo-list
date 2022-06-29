<?php

namespace App\Http\Controllers;


use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TodoController extends Controller
{
   public function index(){
       $todo= Todo::all();
       return response()->json($todo,Response::HTTP_OK);
   }

   public function store(Request $request){
       $todo = Todo::create([
           'title'=>$request->title,
           'description' => $request->description
       ]);
       return response()->json($request,Response::HTTP_CREATED);
   }
}
