<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table='file';


    public function tasks()
    {
        return $this
                ->belongsToMany(Task::class,'document_file','document_id','file_id')
                ->wherePivot('document_type','task');
    }

    public function answers()
    {
        return $this
                ->belongsToMany(Answer::class,'document_file','document_id','file_id')
                ->wherePivot('document_type','answer');
    }

    
}
