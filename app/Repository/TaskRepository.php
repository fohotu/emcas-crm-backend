<?php 
namespace App\Repository;

use App\Models\Task;
use App\Models\DocumentFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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



    public function updateTask($request)
    {
        
        $model = $this->begetQuery()->find($request->task_id);
        if($model){
            $model->title = $request->title;
            $model->description = $request->description;
            if($model->save()){
                $files = $this->hasArrayItem($request["files"]);
                if($files && isset($files["fileList"])){
                    foreach($files["fileList"] as $file){
                        $fileData [] = [
                            "document_type" => "task",
                            "document_id" => $model->id,
                            "file_id" => $file["response"]["id"],
                            "created_at" => Carbon::now(),
                            "updated_at" => Carbon::now(),
                        ];
                    }
                    DocumentFile::insert($fileData);
                }
                return true;
            }
            return false;
        }


      

        

    }


   
    


}
?>