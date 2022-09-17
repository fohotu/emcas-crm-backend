<?php 
namespace App\Repository;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends CoreRepository
{

    protected function getModel()
    {
        return Task::class;
    }

    public function create($request)
    {       

    }

    public function getUserTasks($limit=10)
    {
        $model = $this->begetQuery()::select([
            'id',
            'title',
            'description',
            'status'
        ])
        ->where([
            'created_by' => Auth::user()->id,
        ])
        ->paginate($limit);

        return $model;

    }


    public function getById($id){
        $model = $this->begetQuery()::select([
            'id',
            'title',
            'description',
            'status',
            'work_id',
        ])
        ->with([
            'files',    
            'work',
            'user' => function($query){
                $query->with([
                    'recipient' => function($query){
                        $query->with([
                            'profile'
                        ]);
                    }
                ]);   
            }
        ])
        ->where([
            'id' => $id,
        ])
        ->first();

        return $model;

    }


   
    


}
?>