<?php 
namespace App\Repository;


use App\Models\File as FileModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FileRepository extends CoreRepository
{

    protected function getModel()
    {
        return FileModel::class;
    }

    public function upload($request)
    {
        $fileRequest = $request->file('file');
        $name = $fileRequest->getClientOriginalName();
        $extension = $fileRequest->getClientOriginalExtension();
        $name = $fileRequest->getClientOriginalName();
        $downloadLink = Str::random(10).time().Str::random(10).'.'.$extension;
        $path = $fileRequest->storeAs('public',$downloadLink);
        $fileModel = new FileModel;
        $fileModel->link = $downloadLink;
        $fileModel->title = $name;
        $fileModel->type = $extension;

        if($fileModel->save()){
            File::copy(storage_path('app/'.$path),public_path('download/'.$downloadLink));
            return $fileModel;
        }
        
    }

    public function remove($request)
    {

        $fileModel=$this->begetQuery()::find($request->response['id']);
        if($fileModel){
            $fileModel->delete();
            Storage::delete('public/'.$request->response['link']);
        }

    }

    public function removeWithRelation($request)
    {
        $fileModel = $this->begetQuery()::find($request->response['id']);
        if($fileModel){
            //Db::table('document_file')->where('document_id',$fileModel->id)->delete();
            //$fileModel->foreign('document_id')->references('id')->on('tasks')->onDelete('cascade');
            $fileModel->delete();
            //Storage::delete('public/'.$request->response['link']);
        }
    }


}
?>