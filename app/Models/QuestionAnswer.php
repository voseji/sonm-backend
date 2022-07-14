<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $attach = [
        'isChecked'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'answer_id', 'id');
    }

    public function isChecked($studentId)
    {
        return $this->answers()->where('student_id', $studentId);
    }
}
