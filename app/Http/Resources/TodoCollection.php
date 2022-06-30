<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollection extends ResourceCollection
{
    private $message;

    public function __construct($resource,$message)
    {
        parent::__construct($resource);
        $this->message=$message;
    }

    public function toArray($request)
    {
        return [
            'data'=>$this->collection->map(function ($item){
              return new TodoResource($item,'');
            })
        ];
    }

    public function with($request)
    {
        return [
            'status'=>'success',
            'message'=> $this->message
        ];
    }
}

