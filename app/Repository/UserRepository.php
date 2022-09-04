<?php 
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends CoreRepository
{

    protected function getModel()
    {
        return User::class;
    }


    public function loginAndGetAuthData($request){
        $model = $this->begetQuery()
        ::select(['id','password','role'])
        ->with('profile')
        ->where(['email'=>$request->email])
        ->first();

        if($model && Hash::check($request->password,$model->password)){
            $authData=[
                'full_name' => $model->profile->full_name,
                '_token' => $model->createToken($request->email)->plainTextToken,
                '_id' => $model->id,
                '_role' => $model->role,
            ];
            return  $authData;
        }
        return false;
    }

    public function getUserListForNewTask()
    {
        $model = $this->begetQuery()
            ::select(['id'])
            ->with([
                'profile' => function($query){
                    $query->select(['id','full_name','user_id']);
                } 
            ])->get();

        return $model;        
    }


}
?>