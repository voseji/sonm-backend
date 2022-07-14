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
        })->with(['questions', 'questions.answers'])->get();

        return response()->json($subjects);
    }
}
