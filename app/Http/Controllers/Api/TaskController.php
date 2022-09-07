<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\UserTaskRepsitory;

class TaskController extends Controller
{
    public function index(UserTaskRepsitory $userTaskRepsitory,$category,$box)
    {
        return $userTaskRepsitory->getTaskByCategory($category,$box);
    }

    public function single(UserTaskRepsitory $userTaskRepsitory,$id)
    {
        return $userTaskRepsitory->getTaskById($id);  
    }

    public function create(UserTaskRepsitory $userTaskRepsitory,Request $request)
    {
        $result = $userTaskRepsitory->create($request);
        return response()->json($result);
    
    }
    
    
}
