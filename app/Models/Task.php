<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = [
        'work_id',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function user()
    {
        return $this->hasMany(UserTask::class);
    }

    public function files()
    {
        return $this
                ->belongsToMany(File::class,'document_file','document_id','file_id')
                ->wherePivot('document_type','task');
    }
}
