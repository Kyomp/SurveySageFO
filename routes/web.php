<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('register');
});

Route::prefix('/points')->group(function () {
    Route::get('', [PointsController::class,'pointpage'])->name('points');
    Route::get('/{number}', [PointsController::class,'exchangePoints'])->name('exchange');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomePageController::class, "homepage"])->name('dashboard');
});

Route::prefix('/survey')->group(function(){
    Route::get('/manage', [SurveyController::class, "ManageSurvey"])->name('ManageSurvey');

    Route::get('/create', [SurveyController::class, "CreateSurvey"]);

    Route::get('/edit/{survey_id}', [SurveyController::class, "EditSurvey"]);

    Route::post('/edit/{survey_id}', [SurveyController::class, "SaveSurvey"]);

    Route::get('/open/{survey_id}', [SurveyController::class, "OpenSurvey"]);

    Route::get('/close/{survey_id}', [SurveyController::class, "CloseSurvey"]);

    Route::get('/analyze/{survey_id}', [SurveyController::class, "AnalyzeSurvey"]);
});

Route::prefix('/survey/participate')->group(function(){
    Route::get('/{survey_id}', [QuestionController::class, "TakeSurvey"]);

    Route::get('/answer/{survey_id}', [QuestionController::class, "AnswerSurvey"]);
    Route::post('/answer/{survey_id}', [AnswersController::class, "SaveAnswers"]);
    
});



