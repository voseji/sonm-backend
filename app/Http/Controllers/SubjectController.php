<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function index()
    {
        $subjects = Subject::whereHas('questions', function ($query) {
            $query->whereNotNull('question');
        })->with(['questions', 'questions.answers', 'questions.answers.answers' => function ($query) {
            $query->where('student_id', 1);
        }])->get();

        return response()->json($subjects);
    }
}
