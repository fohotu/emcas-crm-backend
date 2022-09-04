<?php 
namespace App\Repository;

use App\Models\Category;


class CategoryRepository extends CoreRepository
{

    protected function getModel()
    {
        return Category::class;
    }

    public function getCategoryList()
    {
        $model = $this->begetQuery()
            ::select(['id','title'])
            ->get();

        return $model;  
    }
    

}
?>