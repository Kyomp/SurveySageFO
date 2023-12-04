<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use Auth;
use Illuminate\Support\Facades\Redirect;

class AnswersController extends Controller
{
    function SaveAnswers(Request $request){
        // dd($request->all());

        $Answer_List = $request->validate([
            'answers.*' => 'required',
            'UserId.*' => 'required',
            'QuestionId.*' => 'required',
            'SurveyId.*' => 'required',
        ]);

        $Answers = $Answer_List['answers'];
        $UserId = $Answer_List['UserId'];
        $QuestionId = $Answer_List['QuestionId'];
        $SurveyId = $Answer_List['SurveyId'];

        foreach($Answers as $index => $Answer){
            $answer = new Answer;
            $answer->user_id = $UserId[$index];
            $answer->question_id = $QuestionId[$index];
            $answer->survey_id = $SurveyId[$index];
            $answer->answer = $Answer;
            $answer->save();
        }

        return Redirect::to('/dashboard');
    }
}
