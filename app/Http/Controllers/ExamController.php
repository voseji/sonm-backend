<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Students;
use App\Models\Subject;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        \Log::info($request->studentId);
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

    public function uploadQuestions(Request $request)
    {
        $this->validate($request, [
            'questions' => 'required|array',
            'batchNumber' => 'required|string',
            'subject' => 'required|numeric',
        ]);

        $subject = Subject::where('subject', $request->subject)->orWhere('id', $request->subject)->first();
        \Log::info($subject);
        $subject_question_exists = Question::where('subject_id', $subject->id)->count();

        if ($subject_question_exists) {
            throw new HttpException(400, "Subject questions have already been uploaded");
        }
        foreach ($request->questions as $key => $question) {
            $newQuestion = new Question();
            // $newQuestion->id = Question::all()->count() + 1;
            $newQuestion->subject_id = $subject->id;
            $newQuestion->batch = $request->batchNumber;
            $newQuestion->question = $question[0];
            $newQuestion->answer = 'A';
            $newQuestion->save();

            for ($i = 1; $i < sizeof($question); $i++) {
                $is_correct = substr(strval($question[$i]), 0, 2) === '##';
                $newQuestionAnswer = new QuestionAnswer();
                $newQuestionAnswer->question_id = $newQuestion->id;
                $newQuestionAnswer->key = "A";
                $newQuestionAnswer->is_correct = $is_correct;
                $newQuestionAnswer->answer = $is_correct ? substr($question[$i], 2) : $question[$i];
                $newQuestionAnswer->save();
            }
        }
    }


    public function updateQuestion(Request $request, $question_id){
        $question = Question::findOrFail($question_id);

        $question->question = $request->question;
        $question->save();

        foreach($request->answers as $answerItem){
                $is_correct = substr(strval($answerItem['answer']), 0, 2) === '##';
            
            $answer = QuestionAnswer::find($answerItem['id']);
            $answer->is_correct = $is_correct;
            $answer->answer = $is_correct ? substr($answerItem['answer'], 2) : $answerItem['answer'];
            $answer->save();
        }
    }
}
