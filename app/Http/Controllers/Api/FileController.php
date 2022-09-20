<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\FileRepository;
use App\Repository\DocumentFileRepository;

class FileController extends Controller
{
    //

    public function upload(Request $request,FileRepository $fileRepository)
    {
        $uploaded=$fileRepository->upload($request);
        if($uploaded)
            return response()->json($uploaded);
    }

    public function remove(Request $request,DocumentFileRepository $fileRepository)
    {
        //$removed=$fileRepository->remove($request);
        $removed=$fileRepository->removeWithRelation($request);
        //removeWithRelation
        return $request;
        //  if($removed)
        //    return response()->json($removed);
        
        
    }

}
