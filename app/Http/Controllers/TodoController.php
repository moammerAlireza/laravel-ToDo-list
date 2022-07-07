<?php

namespace App\Http\Controllers;


use App\Http\Requests\UploadTodoRequest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Jobs\SendTodoCreatedMail;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\customApiResponser;
use App\Http\Requests\storeTodoRequest;
use App\Http\Requests\updateTodoRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    use customApiResponser;

    public function index()
    {
        //        App::setLocale('fa');
        //        $locale=App::currentLocale();
        //        if (App::isLocale('fa')){
        //
        //            dd($locale);
        //        }
        $todo = Todo::paginate(8);
        return new TodoCollection($todo, __('messages.todo.index.success'));
    }

    public function store(StoreTodoRequest $request)
    {

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_url'=> $request->file_url
        ]);
        if (!$todo) {
            return $this->errorResponse([],__('messages.todo.store.failed'));
        }
        dispatch(new SendTodoCreatedMail($todo->title));
        return new TodoResource($todo,__('messages.todo.store.success'));
    }

    public function update(Todo $todo, updateTodoRequest $request)
    {
        $todo->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        if (!$todo) {
           return $this->errorResponse([],__('messages.todo.update.failed'));
        }
        return new TodoResource($todo, __('messages.todo.update.success'));
    }

    public function destroy(Todo $todo)
    {
        $result = $todo->delete();
        if (!$result) {
            return $this->errorResponse([],__('messages.todo.destroy.failed'));
        }
        return $this->successResponse([],__('messages.todo.destroy.success'));
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo, __('messages.todo.show.success'));
    }

    public function upload(UploadTodoRequest $request)
    {
        $file= $request->file('todo_file');
        $result= $file->store('public/pictures');
        if(!$result){
            return $this->errorResponse([],__('messages.todo.upload.failed'));
        }
        return $this->successResponse([
            'todo_file'=>env('APP_URL'). ":" . env('App_PORT'). Storage::url($result)
        ],__('messages.todo.upload.success'));
    }
}
