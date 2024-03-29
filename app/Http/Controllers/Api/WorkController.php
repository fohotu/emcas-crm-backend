<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\WorkRepository;

class WorkController extends Controller
{
    //

    public function getByCategory($categoryId,WorkRepository $workRepository)
    {
        $response = $workRepository->getAllWorkListByCategory($categoryId);
        return response()->json($response);
    }

    public function getWithPaginate($categoryId,WorkRepository $workRepository)
    {
        $response = $workRepository->getPaginatedListByCategory($categoryId);
        return response()->json($response);
    }

    public function create(Request $request,WorkRepository $workRepository)
    {
        return $workRepository->createNewJob($request);
    }

    public function single($id,WorkRepository $workRepository)
    {
        $response = $workRepository->getOne($id);
        return response()->json($response);
    }

    public function update(Request $request,WorkRepository $workRepository)
    {
        $result = $workRepository->updateJob($request);
        if(!$result){
            return response()->json(['updated'=>false]);
        }
        return response()->json(['updated'=>true]);

    }



}
