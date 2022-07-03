<?php

namespace App\Http\Controllers;


use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\customApiResponser;
use App\Http\Requests\storeTodoRequest;
use App\Http\Requests\updateTodoRequest;

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
            'description' => $request->description
        ]);
        if (!$todo) {
            return $this->errorResponse([],'Failed to create ToDo');
        }
        return new TodoResource($todo, 'Todo created successfully');
    }

    public function update($id, updateTodoRequest $request)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        if (!$todo) {
           return $this->errorResponse([],'Failed to update ToDo');
        }
        return new TodoResource($todo, "Todo Updated successfully.");
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $result = $todo->delete();
        if (!$result) {
            return $this->errorResponse([],'Failed to delete ToDo');
        }
        return $this->successResponse([],'ToDo deleted successfully');
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return new TodoResource($todo, "todo received successfully");
    }
}
