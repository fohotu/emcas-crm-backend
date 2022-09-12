<?php 
namespace App\Repository;

use App\Models\Answer;
use App\Models\DocumentFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnswerRepository extends CoreRepository
{

    protected function getModel()
    {
        return Answer::class;
    }

    public function create($request)
    {
    
        $answer = new Answer;
        $answer->title = $request->title;
        $answer->description = $request->description;
        $answer->user_task_id = $request->task_id;
        $answer->created_by = Auth::user()->id;
        $data = [];
        $fileData = [];
        if($answer->save()){
           
            $files = $this->hasArrayItem($request["files"]);
            if($files){
                foreach($files["fileList"] as $file){
                    $fileData [] = [
                        "document_type" => "answer",
                        "document_id" => $answer->id,
                        "file_id" => $file["response"]["id"],
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ];
                }
                DocumentFile::insert($fileData);
            }
           return true; 
        }else {
            return false;
        }
    }


}
?>