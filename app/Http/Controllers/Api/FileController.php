<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\FileRepository;

class FileController extends Controller
{
    //

    public function upload(Request $request,FileRepository $fileRepository)
    {
        $uploaded=$fileRepository->upload($request);
        if($uploaded)
            return response()->json($uploaded);
    }

    public function remove(Request $request,FileRepository $fileRepository)
    {
        $removed=$fileRepository->remove($request);
        return $request;
        //  if($removed)
        //    return response()->json($removed);
        
        
    }

}
