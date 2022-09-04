<?php 
namespace App\Repository;

use App\Models\Comment;


class CommentRepository extends CoreRepository
{

    protected function getModel()
    {
        return Comment::class;
    }


}
?>