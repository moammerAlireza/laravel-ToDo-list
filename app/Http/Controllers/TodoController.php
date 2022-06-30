<?php

namespace App\Http\Controllers;


use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TodoController extends Controller
{
   public function index(){
       $todo= Todo::paginate(8);
       return response()->json($todo,Response::HTTP_OK);
   }

   public function store(Request $request){

//       $todo= new Todo();
//       $todo->title = $request->input('title');
//       $todo->description = $request->input('description');

//       $todo= new Todo();
//       $todo->title = $request->title;
//       $todo->description = $request->description;
//       $todo->save();

       $todo = Todo::create([
           'title'=>$request->title,
           'description' => $request->description
       ]);
       return response()->json($request,Response::HTTP_CREATED);
   }

   public function update($id ,Request $request){
       $todo=Todo::findOrFail($id);
       $todo->update([
           'title'=>$request->title,
           'description'=>$request->description
       ]);
       return response()->json($todo,Response::HTTP_OK);
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
       return response()->json($todo,Response::HTTP_OK);
   }
}
