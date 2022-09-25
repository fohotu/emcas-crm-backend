<?php 
namespace App\Repository;

use App\Models\UserTask;
use App\Models\Task;
use App\Models\DocumentFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;


class UserTaskRepsitory extends CoreRepository
{


    protected function getModel()
    {
        return UserTask::class;
    }


    public function getTaskByCategory($category,$box = "inbox",$limit = 12)
    {
        
        if($box == "inbox"){
            $where = [
                'recipient_id'=>Auth::user()->id
            ];
        } else {
            $where = [
                'sender_id'=>Auth::user()->id
            ];
        }
        
        $model = $this->begetQuery()::with(
            [
                'task' => function($query){
                    $query->with('work');
                },
                'recipient',
                'sender'
            ])->whereHas('task',function( $query) use ($where,$category){
                $query->whereHas('work',function( $query) use($category){
                    $query->where(['category_id'=>$category]);
                })
            ->where($where);
        })->orderByDesc('id');
      

        return $model->paginate($limit);
    }
   

    public function getTaskList($category=null,$inbox=true,$limit=2)
    {

        $where = [];
        if($category){
            $where['category_id']=$category;
        }
        
        if($inbox){
            $where['recipient_id']=Auth::user()->id;
        }else{
            $where['sender_id']=Auth::user()->id;
        } 

        
        $model = $this->begetQuery()::select()
            ->where($where)
            ->with([
                'sender',
                'answer' => function ($query) {
                    $query->with(['comments' => function($query){
                        $query->select(['id','type','body']);
                    }]);
                },
                'task' => function($query) {
                    $query->select(['id','title','work_id'])->with(['work']);
            }])->paginate($limit);

        return $model;

    }


    public function getTaskById($id)
    {
        $model=$this->begetQuery()::where(['id'=>$id])
        ->with(
            [
                'answer'=>function($query){
                    $query->with([
                        'files',
                        'comments',
                    ]);
                },
                'task'=>function($query){
                    $query->with([
                        'work',
                        'files',
                    ]);
                }
            ]
        )->first();

        return $model;
        
    }


    public function create($request)
    {
      
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->work_id = $request->job;
        $task->created_by = Auth::user()->id;
        $data = [];
        $fileData = [];
        if($task->save()){
            $users = $this->hasArrayItem($request->users);
            $files = $this->hasArrayItem($request["files"]);
            if($files){
                foreach($files["fileList"] as $file){
                    $fileData [] = [
                        "document_id" => $task->id,
                        "document_type" => "task",
                        "file_id" => $file["response"]["id"],
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ];
                }
                DocumentFile::insert($fileData);
            }

            if($users){
                foreach($users as $user){
                   $data [] = [
                        "sender_id" => $request->user()->id,
                        "recipient_id" => $user["id"],
                        "task_id" => $task->id,
                        "deadline" => $user["deadline"], 
                        "description" => $user["comment"], 
                        "status" => "active",
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ]; 
                }
                $this->begetQuery()::insert($data);
            }
           return true; 
        }else {
            return false;
        }
    }


    public function addUserToTask($request)
    {
        $data = [
            "task_id" => $request->task_id,
            "sender_id" => Auth::user()->id,
            "recipient_id" => $request->user,
            "deadline" => $request->deadline,
            "description" => $request->description,
            "status" => "active",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];   
        $model = $this->begetQuery()::create($data);
        return $model;
    }


    public function removeUserFromTask($id)
    {
        $model = $this->begetQuery()::find($id);
        if($model)
            return $model->delete();
        return false;
    }


    public function changeTaskStatus($id,$status)
    {
        $model = $this->begetQuery()::find($id);
        if($model){
            $model->status = $status;
            return $model->save();
        }
        return false;

            
    }



   

}

?>