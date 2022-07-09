<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    private $message;
    private $token;

    public function __construct($resource,$message,$token)
    {
        parent::__construct($resource);
        $this->message=$message;
        $this->token=$token;
    }

    public function toArray($request)
    {
        return [
            'email'=>$this->email,
            'api_token'=>$this->token
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
