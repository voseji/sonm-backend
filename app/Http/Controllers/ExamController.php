<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\QuestionAnswer;
use App\Models\Students;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->validate($request, [
            'questionId' => 'required|numeric',
            'studentId' => 'required|string',
            'answerId' => 'required|numeric',
        ]);

        $student = Students::where('registrationNumber', $request->studentId)->first();
        $answer = QuestionAnswer::find($request->answerId);
        $existingResponse = Answer::where('question_id', $request->questionId)->where('student_id', $student->id)->first();

        if ($existingResponse) {
            $existingResponse->answer_id = $request->answerId;
            $existingResponse->is_correct = $answer->is_correct;
            $existingResponse->save();
        } else {
            $new_answer = new Answer();
            $new_answer->answer_id = $request->answerId;
            $new_answer->student_id = $student->id;
            $new_answer->question_id = $request->questionId;
            $new_answer->is_correct = $answer->is_correct;
            $new_answer->save();
        }
    }
}
