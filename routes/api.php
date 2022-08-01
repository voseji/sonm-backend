<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

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


Route::get('/subject/{id}', [SubjectController::class, 'oneSubject']);
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/test/subjects/{student_id}', [SubjectController::class, 'getTestQuestions']);
Route::post('/questions/respond', [ExamController::class, 'store']);
Route::post('/questions', [ExamController::class, 'uploadQuestions']);
Route::put('/questions/{question_id}',[ExamController::class,'updateQuestion']);

// Route::get('/batches', [BatchesController::class, 'getAllBatches']);
// Route::post('/batches', [BatchesController::class, 'createBatches']);

Route::get('/subject_questions/{subject_id}', [QuestionsController::class, 'getQuestion']);
Route::get('/one_question/{id}', [QuestionsController::class, 'getOneQuestion']);

Route::get('/get_answers/{id}', [QuestionsController::class, 'getAnswers']);
Route::patch('/batches/{batch_id}', [BatchesController::class, 'updateBatch']);



// Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
// Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
// Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
// Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');

// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::controller(BatchesController::class)->group(function () {
// Route::get('/batches', [BatchesController::class, 'getAllBatches']);
// Route::post('/batches', [BatchesController::class, 'createBatches']);
Route::get('/batches', 'getAllBatches');
}); 