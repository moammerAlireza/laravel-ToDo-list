<?php

namespace App\Http\Controllers;


use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TodoController extends Controller
{
   public function index(){
       $todo= Todo::paginate(8);
       return new TodoCollection($todo,'Todos received successfully');
   }

   public function store(Request $request){

       $todo = Todo::create([
           'title'=>$request->title,
           'description' => $request->description
       ]);
       return new TodoResource($todo,'Todo created successfully');
   }

   public function update($id ,Request $request){
       $todo=Todo::findOrFail($id);
       $todo->update([
           'title'=>$request->title,
           'description'=>$request->description
       ]);
       return new TodoResource($todo,"Todo Updated successfully.");
   }

   public function destroy($id){
       $todo=Todo::findOrFail($id);
       $todo->delete();
       $result=[
           'status'=>'success',
           'message'=> 'ToDo deleted successfully'
       ];
       return response()->json($result,Response::HTTP_OK);
   }

   public function show($id){
       $todo=Todo::findOrFail($id);
       return new TodoResource($todo,"todo received successfully");
   }
}
