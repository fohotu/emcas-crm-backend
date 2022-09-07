<?php 
namespace App\Repository;

use App\Models\Task;


class TaskRepository extends CoreRepository
{

    protected function getModel()
    {
        return Task::class;
    }

    public function create($request)
    {

        

       
    }


}
?>