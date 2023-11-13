<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use Auth;

class SurveyController extends Controller
{
    function ManageSurvey() {
        $ownSurveys = Survey::all()->where("user_id", Auth::user()->id);

        $questions = [];
        foreach ($ownSurveys as $survey) {
            $surveyId = $survey->id;

            // Use the survey ID to filter questions
            $questions[$surveyId] = Question::all()->where("survey_id", $surveyId)->count();
        }

        return view('ManageSurvey',['ownSurveys' => $ownSurveys, 
                                    'user' => Auth::user(),
                                    'questions' => $questions]);
    }

    function CreateSurvey(){
        $QuestionsArray = [];
        return view('CreateSurvey', ['questions'=> $QuestionsArray]);
    }

    function StoreSurvey(Request $request){
        // dd($request->all());

        $SurveyData = $request->validate([
            'title' => 'required',
        ]);

        $SurveyData['user_id'] = Auth::user()->id;
        $SurveyData['points'] = 200;
        $SurveyData['open'] = 1;

        $survey = Survey::create($SurveyData);

        $questions = $request->validate([
            'questions.*' => 'required',
        ]);

        $questionData = $request->questions;
        foreach($questionData as $question) {
            $quest = new Question;
            $quest->question = $question;
            $quest->question_type = 1;
            $quest->survey_id = $survey->id;
            $quest->save();
            // Question::create($question);
        }
    }

    function ViewSurvey(){

    }
}
