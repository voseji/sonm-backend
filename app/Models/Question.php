<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
