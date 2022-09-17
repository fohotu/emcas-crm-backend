<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    
    use HasFactory;
    
    protected $table='user_task';

    protected $fillable=[
        'sender_id',
        'recipient_id',
        'task_id',
        "deadline" ,
        "description",
        "status",
    ];


    public function task()
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class);
    }



    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

}
