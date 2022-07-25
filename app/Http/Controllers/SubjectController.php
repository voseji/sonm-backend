<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function getTestQuestions($student_id)
    {
        $subjects = Subject::whereHas('questions', function ($query) {
            $query->whereNotNull('question');
        })->with(['questions', 'questions.answers', 'questions.answers.answers' => function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        }])->get();

        return response()->json($subjects);
    }

    public function index()
    {
        $subjects = Subject::orderBy('subject', 'asc')->get();

        return response()->json($subjects);
    }
}
