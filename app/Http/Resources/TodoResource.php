<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'file_url'=>$this->file_url == null ? "" : $this->file_url,
            'deleted_at'=>$this->deleted_at == null ? "" : $this->deleted_at->diffForHumans()
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
