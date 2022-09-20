<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\UserTaskRepsitory;
use App\Repository\TaskRepository;

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
        
        if(!$result){
            return response()->json(['saved'=>false]);
        }
        
        return response()->json(['saved'=>true]);
    }
    

    public function getUserTask(TaskRepository $taskRepository)
    {

        $model = $taskRepository->getUserTasks();
        return response()->json($model);

    }

    public function view(TaskRepository $taskRepository,$id)
    {
        $model = $taskRepository->getById($id);
        return response()->json($model);
    }

    public function addUserToTask(UserTaskRepsitory $userTaskRepsitory,Request $request){
        $model = $userTaskRepsitory->addUserToTask($request);
        return response()->json($model);
    }

    public function update(TaskRepository $taskRepository,Request $request)
    {
        $result = $taskRepository->updateTask($request);


        if(!$result){
            return response()->json(['saved'=>false]);
        }    
        return response()->json(['saved'=>true]);
    
    }  
    
    
    public function removeUserFromTask(UserTaskRepsitory $userTaskRepsitory,Request $request)
    {
        $result = $userTaskRepsitory->removeUserFromTask($request->id);
        if(!$result){
            return response()->json(['removed' =>false]);
        }    
        return response()->json(['removed' =>true]);
    }
    
}
