<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SurveyController;
use app\Http\Controllers\QuestionController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomePageController::class, "homepage"])->name('dashboard');
});

Route::get('/ManageSurvey', [SurveyController::class, "ManageSurvey"])->name('ManageSurvey');

Route::get('/CreateSurvey', [SurveyController::class, "CreateSurvey"])->name('CreateSurvey');

Route::post('/CreateSurvey', [SurveyController::class, "StoreSurvey"])->name('StoreSurvey');


