<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;


    protected $table = 'work';
    protected $fillable = [
        'category_id',
        'created_by'
    ];

    public function files()
    {
        return $this
                ->belongsToMany(File::class,'document_file','document_id','file_id')
                ->wherePivot('document_type','work');
    }
}
