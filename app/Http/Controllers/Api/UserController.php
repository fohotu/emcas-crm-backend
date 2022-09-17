<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\UserRepository;

class UserController extends Controller
{
    public function login(Request $request,UserRepository $userRepository)
    {
        $response = $userRepository->loginAndGetAuthData($request);
        if(!$response)
            return response()->json(['message'=>'Unauthenticated'],401);
        return response()->json($response);    
    }

    public function list(UserRepository $userRepository)
    {
       $response = $userRepository->getUserListForNewTask();
       return response()->json($response); 
    }

   

}
