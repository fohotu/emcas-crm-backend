<?php 
namespace App\Repository;

use App\Models\DocumentFile;


class DocumentFileRepository extends CoreRepository
{

    protected function getModel()
    {
        return DocumentFile::class;
    }


}
?>