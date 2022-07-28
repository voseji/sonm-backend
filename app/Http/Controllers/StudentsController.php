<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
  // Pull all students
  public function getAllStudents()
  {
    return Students::orderBy('created_at', 'desc')->get();
  }

  //   public function createStudent(Request $request) {
  public function createStudent(Request $request)
  {
    $student = new Students();

    $student->registrationNumber = $request->registrationNumber;
    $student->formNumber = $request->formNumber;
    $student->firstName = $request->firstName;
    $student->lastName = $request->lastName;
    $student->otherNames = $request->otherNames;
    $student->gender = $request->gender;
    $student->maritalStatus = $request->maritalStatus;
    $student->dateOfBirth = $request->dateOfBirth;
    $student->phoneNumber1 = $request->phoneNumber1;
    $student->phoneNumber2 = $request->phoneNumber2;
    $student->stateOfOrigin = $request->stateOfOrigin;
    $student->lga = $request->lga;
    $student->special = $request->special;

    $student->save();

    return response()->json([
      "message" => "student record created"
    ], 201);
  }


  // Pull one student record
  public function getStudent($id)
  {
    return Students::where('registrationNumber', $id)->firstOrFail();
  }

  // Updating records endpoint
  public function updateStudent(Request $request, $id)
  {
    //\Log::info($request->all());
    if (Students::where('id', $id)->orWhere('registrationNumber', $id)->exists()) {
      $student = Students::where('id', $id)->orWhere('registrationNumber', $id)->first();
      $student->formNumber = is_null($request->formNumber) ? $student->formNumber : $request->formNumber;
      $student->firstName = is_null($request->firstName) ? $student->firstName : $request->firstName;
      $student->lastName = is_null($request->lastName) ? $student->lastName : $request->lastName;
      $student->otherNames = is_null($request->otherNames) ? $student->otherNames : $request->otherNames;
      $student->email = is_null($request->email) ? $student->email : $request->email;
      $student->gender = is_null($request->gender) ? $student->gender : $request->gender;
      $student->maritalStatus = is_null($request->maritalStatus) ? $student->maritalStatus : $request->maritalStatus;
      $student->dateOfBirth = is_null($request->dateOfBirth) ? $student->dateOfBirth : $request->dateOfBirth;
      $student->phoneNumber1 = is_null($request->phoneNumber1) ? $student->phoneNumber1 : $request->phoneNumber1;
      $student->phoneNumber2 = is_null($request->phoneNumber2) ? $student->phoneNumber2 : $request->phoneNumber2;
      $student->stateOfOrigin = is_null($request->stateOfOrigin) ? $student->stateOfOrigin : $request->stateOfOrigin;
      $student->lga = is_null($request->lga) ? $student->lga : $request->lga;
      $student->nationality = is_null($request->nationality) ? $student->nationality : $request->nationality;
      $student->batch = is_null($request->batch) ? $student->batch : $request->batch;
      $student->time_left = is_null($request->time_left) ? $student->time_left : $request->time_left;
      $student->exam_status = is_null($request->exam_status) ? $student->exam_status : $request->exam_status;

      $student->save();

      return response()->json([
        "message" => "records updated successfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Student not found"
      ], 404);
    }
  }

  // Delete one record endpoint
  public function deleteStudent($id)
  {
    if (Students::where('id', $id)->exists()) {
      $student = Students::find($id);
      $student->delete();

      return response()->json([
        "message" => "records deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => "Student not found"
      ], 404);
    }
  }

  public function getStudentResult()
  {
    $query = "select students.*, subjects.subject, count(*) as subject_score from answers join questions  on questions.id=answers.question_id join subjects on subjects.id=questions.subject_id join students on students.id=answers.student_id GROUP by subjects.id, students.id order by students.id";
    $result = DB::select(DB::raw($query));
    return $result;
  }

  public function getAllStudentResult()
  {
    $query = "select students.*, SUM(is_correct) as total_score from answers join students on students.id=answers.student_id GROUP by students.id ";
    $result = DB::select(DB::raw($query));
    return $result;
  }

  public function getStudentBatches()
  {
    $query = "select students.batch from students GROUP by students.batch ";
    $result = DB::select(DB::raw($query));
    return $result;
  }
}
