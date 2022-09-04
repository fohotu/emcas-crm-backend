<?php 
namespace App\Repository;

use App\Models\Work;


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
                    'task'=>function($query){
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
                    'files'=>function($query){
                        $query->select([
                            'title',
                            'link'
                        ]);
                    }
                ]
            )
            ->get();
        return $model;
    }


}
?>