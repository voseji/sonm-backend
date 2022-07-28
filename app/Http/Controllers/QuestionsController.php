<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\QuestionAnswer;

class QuestionsController extends Controller
{
  public function getQuestion(Request $request, $id)
  {
    // \Log::info($id);
    return Question::where('subject_id', $id)->get();
  }

    public function getOneQuestion(Request $request, $id)
  {
    // \Log::info($id);
    return Question::with(['answers'])->where('id', $id)->firstOrfail();
  }


}
