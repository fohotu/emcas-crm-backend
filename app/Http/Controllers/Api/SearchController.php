<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\SearchRepository;

class SearchController extends Controller
{
    //

    public function live($q,SearchRepository $searchRepository)
    {
        $model=$searchRepository->live($q);
        return response()->json($model);
    }

    public function simple($q,SearchRepository $searchRepository)
    {
        $model=$searchRepository->simple($q);
        return response()->json($model);
    }

    public function filter($start=null,$end=null,$category=null,$term=null,SearchRepository $searchRepository)
    {
        $model=$searchRepository->filter($start,$end,$category,$term);
        return response()->json($model);
    }
    
}
