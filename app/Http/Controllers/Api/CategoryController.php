<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    //

    public function list(CategoryRepository $categoryRepository)
    {
        $response = $categoryRepository->getCategoryList();
        return response()->json($response); 
    }
}
