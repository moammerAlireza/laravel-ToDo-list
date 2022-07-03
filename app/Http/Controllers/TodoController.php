<?php

namespace App\Http\Controllers;


use App\Http\Requests\UploadTodoRequest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\customApiResponser;
use App\Http\Requests\storeTodoRequest;
use App\Http\Requests\updateTodoRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    use customApiResponser;

    public function index()
    {
        $todo = Todo::paginate(8);
        return new TodoCollection($todo, 'Todos received successfully');
    }

    public function store(StoreTodoRequest $request)
    {

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_url'=> $request->file_url
        ]);
        if (!$todo) {
            return $this->errorResponse([],'Failed to create ToDo');
        }
        Mail::send('mails.todo-created',['todoTitle'=>$todo->title], function ($message){
            $message->to('moameralireza@gmail.com')->subject('New Todo');
        });
        return new TodoResource($todo, 'Todo created successfully');
    }

    public function update(Todo $todo, updateTodoRequest $request)
    {
        $todo->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        if (!$todo) {
           return $this->errorResponse([],'Failed to update ToDo');
        }
        return new TodoResource($todo, "Todo Updated successfully.");
    }

    public function destroy(Todo $todo)
    {
        $result = $todo->delete();
        if (!$result) {
            return $this->errorResponse([],'Failed to delete ToDo');
        }
        return $this->successResponse([],'ToDo deleted successfully');
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo, "todo received successfully");
    }

    public function upload(UploadTodoRequest $request)
    {
        $file= $request->file('todo_file');
        $result= $file->store('public/pictures');
        if(!$result){
            return $this->errorResponse([],'Uploading file failed');
        }
        return $this->successResponse([
            'todo_file'=>env('APP_URL'). ":" . env('App_PORT'). Storage::url($result)
        ],'File Upload Successfully');
    }
}
