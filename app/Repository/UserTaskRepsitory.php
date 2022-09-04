<?php 
namespace App\Repository;

use App\Models\UserTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

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
                'recipient_id'=>1,//Auth::user()->id
            ];
        } else {
            $where = [
                'sender_id'=>1,//Auth::user()->id
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

}

?>