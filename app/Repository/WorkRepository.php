<?php 
namespace App\Repository;

use App\Models\Work;
use App\Models\DocumentFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorkRepository extends CoreRepository
{


    protected function getModel()
    {
        return Work::class;
    }


    public function getWorkList($category,$limit=10)
    {
        $model = 
            $this->begetQuery()::select(
                ['id','title','description','term']
            )
            ->where(
                ['category_id' => $category ]
            )
            ->orderByDesc('id')
            ->paginate($limit);    

        return $model;
    

    }

    public function getAllWorkListByCategory($category)
    {
        $model = 
            $this->begetQuery()::select(
                ['id','title','description','term']
            )
            ->where(
                ['category_id' => $category ]
            )
            ->orderByDesc('id')
            ->get();    

        return $model;
    

    }


    public function getPaginatedListByCategory($category,$limit=10)
    {
        $model = 
            $this->begetQuery()::select(
                ['id','title','description','term']
            )
            ->where(
                ['category_id' => $category ]
            )
            ->orderByDesc('id')
            ->paginate($limit);    
        return $model;
    

    }

    public function createNewJob($request)
    {
        $model = new Work;
        $model->title = $request->title;
        $model->description = $request->description;
        $model->term = $request->deadline;
        $model->category_id = $request->category;
        $model->created_by =  Auth::user()->id;
        if($model->save()){
            $files = $this->hasArrayItem($request["files"]);
            if($files && isset($files["fileList"])){
                foreach($files["fileList"] as $file){
                    $fileData [] = [
                        "document_type" => "work",
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






    public function getTaskListByWorkCategory($category,$inbox=true,$limit=100)
    {
        $model = 
        $this->begetQuery()::select(
            ['id','title','description','term']
        )->with([
            'task'=>function($query){
                $query->with([
                    'employee'
                ]);
            }
        ])
        ->where(
            ['category_id' => $category ]
        )
        ->orderByDesc('id')
        ->paginate($limit);  
        
        
        return $model;

    }

    public function getOne($id)
    {
        $model =
            $this->begetQuery()
            ::where(['id'=>$id])
            ->with(
                [
                    'task' => function($query){
                        $query->with(['employee'=>function($query){
                            $query->select()
                            ->with([
                                'sender'=>function($query){
                                    $query->select(
                                            [
                                              'id', 
                                              'name'
                                            ]
                                    );
                                },
                                'recipient'=>function($query){
                                    $query->select(
                                        [
                                            'id',
                                            'name'
                                        ]
                                    );
                                },
                                'answer'=>function($query){
                                    $query->select()
                                    ->with([
                                        'files',
                                        'comments'
                                    ]);
                                }
                            ]);
                        }]);
                    },
                    'files' => function($query){
                        $query->select([
                            'title',
                            'link'
                        ]);
                    }
                ]
            )
            ->first();
        return $model;
    }


    public function updateJob($request)
    {
        $model = $this->begetQuery()::find($request->id);
        if($model){
            $model->title = $request->title;
            $model->description = $request->description;
            $model->term = $request->term;
            if($model->save()){
                $files = $this->hasArrayItem($request["files"]);
                $filesList = $this->hasArrayItem($request["files"]["fileList"]);
                if($files && $filesList){
                    foreach($files["fileList"] as $file){
                        $fileData[] = [
                            "document_type" => "work",
                            "document_id" => $model->id,
                            "file_id" => $file["response"]["id"],
                            "created_at" => Carbon::now(),
                            "updated_at" => Carbon::now(),
                        ];
                    }
                    DocumentFile::insert($fileData);
                }
                return true;
            }else{
                return false;
            }    
        }
        return false;
    }


}
?>