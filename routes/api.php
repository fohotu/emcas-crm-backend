<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\AnswerController;

use App\Repository\UserRepository;
use App\Repository\FileRepository;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::post('/login',[UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('file')->group(function(){
        Route::post('/upload',[FileController::class,'upload']);
        Route::post('/remove',[FileController::class,'remove']);    
    });
   

    Route::prefix('category')->group(function(){
        Route::get('/list',[CategoryController::class,'list']);
    });

    Route::prefix('work')->group(function(){
        Route::get('/by-category/{categoryId}',[WorkController::class,'getByCategory']);
        Route::get('/by-category/paginate/{categoryId}',[WorkController::class,'getWithPaginate']);
        Route::post('/create',[WorkController::class,'create']);
    });

    Route::prefix('user')->group(function(){
        Route::get('/list',[UserController::class,'list']);
        Route::get('/task',[TaskController::class,'getUserTask']);
        Route::get('/task/{id}',[TaskController::class,'view']);             
        Route::post('/task/create',[TaskController::class,'addUserToTask']);           
        Route::post('/task/remove',[TaskController::class,'removeUserFromTask']);           
    });



    Route::prefix('tasks')->group(function(){
        Route::get('/index/{category}/{inbox}',[TaskController::class,'index']);
        Route::get('/single/{id}',[TaskController::class,'single']);
        Route::post('/create',[TaskController::class,'create']);
        Route::get('/view/{id}',[TaskController::class,'view']);
        Route::post('/update',[TaskController::class,'update']);
    });

    Route::prefix('answer')->group(function(){
        Route::post('/create',[AnswerController::class,'create']);
    });

    Route::prefix('search')->group(function(){
        Route::get('/live/{q}',[SearchController::class,'live']);
        Route::get('/simple/{q}',[SearchController::class,'simple']);
        Route::get('/filter/{start?}/{end?}/{category?}/{term?}',[SearchController::class,'filter']);
    });    

    

});

Route::get('download/{filename}',function($filename){
    $file_path = storage_path().'/app/public/'.$filename;
    if (file_exists($file_path))
    {
        // https://stackoverflow.com/questions/26971668/how-to-create-download-link-in-laravel
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
        
    }
});

/*

Route::get('/search/{q}',function($q) {

    $queryString = explode(" ",$q);

    $model = App\models\UserTask::whereHas('task',function($query) use($queryString){
        foreach ($queryString as $item) {
            $query
            ->where("title","like","%$item%")
            ->orWhere("description","like","%$item%");
        }   
    })
    ->orWhere (function($query) use($queryString){
        foreach ($queryString as $item) {
            $query->orWhere("description","like","%$item%");
        }
    })
    ->with('task')
    ->limit(10)
    ->get();

    return $model;

});


*/




