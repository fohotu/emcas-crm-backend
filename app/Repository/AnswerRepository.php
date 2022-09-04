<?php 
namespace App\Repository;

use App\Models\Answer;


class AnswerRepository extends CoreRepository
{

    protected function getModel()
    {
        return Answer::class;
    }


}
?>