<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\CustomApiResponser;
use App\Http\Resources\LoginResource;

class AuthController extends Controller
{
    use CustomApiResponser;
    public function register(RegisterRequest $request)
    {
        $user=User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if (!$user){
            return $this->errorResponse([],'could not register,try again later');
        }
        return $this-> successResponse([],'Register successful,try to login', Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $result=Auth::attempt([
            "email"=>$request->email,
            "password"=>$request->password,
        ]);
        if(!$result){
            return $this->errorResponse([],'wrong email or password');
        }
        $token=Auth::user()->createToken('mobile_app')->plainTextToken;
        return new LoginResource(Auth::user(),'Login was successfully',$token);
    }

    public function logout()
    {
        $result=Auth::user()->tokens()->delete();
        if(!$result){
            return $this->errorResponse([],'Could not logout, please try again later');
        }
        return $this->successResponse([],'Logout was successful');
    }
}
