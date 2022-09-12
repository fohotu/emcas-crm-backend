<?php 
namespace App\Repository;


abstract class CoreRepository
{

    protected $model;

    public function __construct()
    {
        $this->model=app($this->getModel());
    }


    abstract protected function getModel();

    protected function begetQuery()
    {
        return clone $this->model;
    }

    protected function hasArrayItem($array){
        if(is_array($array) && (count($array) > 0)){
            return $array; 
        }
        return false;
    }

}

?>