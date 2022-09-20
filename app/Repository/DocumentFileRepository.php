<?php 
namespace App\Repository;

use App\Models\DocumentFile;


class DocumentFileRepository extends CoreRepository
{

    protected function getModel()
    {
        return DocumentFile::class;
    }


    public function removeWithRelation($request)
    {
        $fileModel = $this->begetQuery()::where([
            'file_id' => $request->response['id'],
            'document_id' => $request->response['document_id'],
            'document_type' => $request->response['type']
            ]
        )->first();
        if($fileModel){
           $fileModel->delete();
            //Storage::delete('public/'.$request->response['link']);
        }
    }

}
?>