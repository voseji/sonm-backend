<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\BatchesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/student/batches', [StudentsController::class, 'getStudentBatches']);
Route::get('/student/result2', [StudentsController::class, 'getAllStudentResult']);
Route::get('/student/result', [StudentsController::class, 'getStudentResult']);
Route::get('students', [StudentsController::class, 'getAllStudents']);
Route::get('students/{id}', [StudentsController::class, 'getStudent']);
Route::post('students', [StudentsController::class, 'createStudent']);
Route::put('students/{id}', [StudentsController::class, 'updateStudent']);
Route::delete('students/{id}', [StudentsController::class, 'deleteStudent']);

Route::get('settings', [SettingsController::class, 'getAllSettings']);
Route::get('settings/{id}', [SettingsController::class, 'getSettings']);
Route::post('settings', [SettingsController::class, 'createSettings']);
Route::put('settings/{id}', [SettingsController::class, 'updateSettings']);
Route::delete('settings/{id}', [SettingsController::class, 'deleteSettings']);
Route::get('single-setting', [SettingsController::class, 'getSetting']);

// Route::prefix('v1')->group(function(){
// Route::post('store-file', 'ApiPassportController@store');
// Route::post('store-file', [ApiPassportController::class,'store']);
// Route::post('store-file', [ApiPassportController::class, 'store']);
//    });

Route::get('passport/{special}', [FileUploadController::class, 'getImage']);
Route::post('uploading-file-api', [FileUploadController::class, 'upload']);


Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/test/subjects/{student_id}', [SubjectController::class, 'getTestQuestions']);
Route::post('/questions/respond', [ExamController::class, 'store']);
Route::post('/questions', [ExamController::class, 'uploadQuestions']);

Route::get('/batches', [BatchesController::class, 'getAllBatches']);
Route::post('/batches', [BatchesController::class, 'createBatches']);
Route::patch('/batches/{batch_id}', [BatchesController::class, 'updateBatch']);