<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
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
        ]);

        $Answers = $Answer_List['answers'];
        $UserId = $Answer_List['UserId'];
        $QuestionId = $Answer_List['QuestionId'];

        $surveyor =  User::find(Survey::find(Question::find($QuestionId[0])->survey_id)->user_id);
        $survey = Survey::find(Question::find($QuestionId[0])->survey_id);
        $surveyPoints = $survey->points;

        if($surveyor->points >= $surveyPoints && $survey->open = 1){
            foreach($Answers as $index => $Answer){
                $answer = new Answer;
                $answer->user_id = $UserId[$index];
                $answer->question_id = $QuestionId[$index];
                $answer->answer = $Answer;
                $answer->save();
            }
    
            $answerer = Auth::user();
            $answerer->points = $answerer->points + $surveyPoints;
            $answerer->save();

            $surveyor->points = $surveyor->points - $surveyPoints;
            $surveyor->save();
        }
        
        if($surveyor->points<$surveyPoints){
            $survey->open = 0;
            $survey->save();
        }

        return Redirect::to('/dashboard');
    }
}
