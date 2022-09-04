<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'task_answer';

    protected $filable = [
        'user_task_id',
    ];

    public function user()
    {
        return $this->belongsTo(UserTask::class,'user_task_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this
                ->belongsToMany(File::class,'document_file','document_id','file_id')
                ->wherePivot('document_type','answer');
    }
        
}
