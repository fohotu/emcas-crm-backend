<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\AnswerRepository;

class AnswerController extends Controller
{
    //
    public function create(Request $request,AnswerRepository $answerRepository)
    {
        $result = $answerRepository->create($request);
        
        if(!$result){
            return response()->json(['saved'=>false]);
        }     
        return response()->json(['saved'=>true]);
   
    }

}
