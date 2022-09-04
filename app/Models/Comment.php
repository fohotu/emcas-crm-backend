<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table='answer_comment';

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
