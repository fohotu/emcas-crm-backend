<?php 
namespace App\Repository;

use App\Models\Task;
use App\Models\Answer;
use App\Models\UserTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class SearchRepository
{

    public function live($q)
    {
        return $this->searchQuery($q)->limit(10)->get();
    }

    public function simple($q)
    {
        return $this->searchQuery($q)->paginate(10);
    }

    private  function searchQuery($searchString)
    {
        $queryString = explode(" ",$searchString);
        $query = UserTask::select(
            [
                'id',
                'description',
                'task_id',
            ])
        ->whereHas('task',function($query) use($queryString){
            foreach ($queryString as $item) {
                $query
                ->where("title","like","%$item%")
                ->orWhere("description","like","%$item%");
            }   
        })
        ->where (function($query){
            $query
            ->where('sender_id','=',Auth::user()->id)
            ->orWhere('recipient_id','=',Auth::user()->id);
        })
        ->where (function ($query) use ($queryString) {
            foreach ($queryString as $item) {
                $query->orWhere("description","like","%$item%");
            }
        })
        ->with([
            'task' => function($query){
                $query->select(['id','title','description']);
            }
        ]);

        return $query;

    } 

    public function filter($start=null,$end=null,$category=null,$limit=10)
    {

        $start = new Carbon($start);
        $end = new Carbon($end);
       
        $model = UserTask::select(
            [
                'id',
                'description',
                'task_id',
                'status',
                'recipient_id',
                'sender_id'
            ])
        ->whereHas('task')
        ->where('status','=','deadTime')
        ->where(function ($query) use ($start,$end) {
            $query->where (
                'recipient_id','=',Auth::user()->id
            );

               /*
               $query->where (
                'sender_id','=',Auth::user()->id
            )
            ->orWhere('recipient_id','=',Auth::user()->id);
               */ 

        })
        ->whereBetween('created_at', [
            $start,
            $end,
        ])
        ->with([
            'task' => function ($query) use ($category) {
                $query->select (['id','title','description','work_id'])
                ->whereHas('work', function($query) use($category) {
                    if($category) {
                        $query->where('category_id','=',$category);
                    }
                })
                ->with('work');
            }
        ])->paginate($limit);
        
        return $model;
       

    }


}
?>