<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use Auth;

class QuestionController extends Controller
{
    function TakeSurvey($survey_id){
        $survey = Survey::all()->where("id", $survey_id)->first();
        return view('TakeSurvey', ["survey"=>$survey]);
    }

    function AnswerSurvey($survey_id){
        $user = Auth::user();
        $survey = Survey::all()->where("id", $survey_id)->first();
        $questions = Question::all()->where("survey_id", $survey_id);
        return view('AnswerSurvey', [ 'user'=>$user, "survey"=>$survey, "questions"=>$questions]);
    }

}
