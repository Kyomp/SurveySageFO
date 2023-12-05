<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use Auth;
use Illuminate\Support\Facades\Redirect;

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
        $survey = new Survey;
        $survey->user_id = Auth::user()->id;
        $survey->points = 0;
        $survey->open = 0;
        $survey->title = '';
        $survey->save();
        return Redirect::to("/survey/edit/$survey->id");
    }

    function EditSurvey($survey_id){
        $survey = Survey::all()->where("id", $survey_id)->first();
        $questions = Question::all()->where("survey_id", $survey_id);
        return view('EditSurvey', ["survey"=>$survey, "questions"=>$questions]);
    }

    function SaveSurvey(Request $request, $survey_id){

        $survey_questions = $request->validate([
            'questions.*' => 'required',
            'id.*' => 'required',
            'type.*' => 'required',
            'choice1.*' => 'required',
            'choice2.*' => 'required',
            'choice3.*' => 'required',
            'choice4.*' => 'required',
        ]);

        $questions = $survey_questions['questions'];
        $ids = $survey_questions['id'];
        $types = $survey_questions['type'];
        if(array_key_exists('choice1', $survey_questions)){
            $choice1 = $survey_questions['choice1'];
            $choice2 = $survey_questions['choice2'];
            $choice3 = $survey_questions['choice3'];
            $choice4 = $survey_questions['choice4'];
        }
        $count = 0;
        $pointTotal = 0;
        foreach( $questions as $index => $question ) {
            if($types[$index]==2){
                $question = $question."[{".$choice1[$count]."}{".$choice2[$count]."}{".$choice3[$count]."}{".$choice4[$count]."}]";
                $count+=1;
                $pointTotal+=2;
            } 
            else{
                $pointTotal+=3;
            }

            if($ids[$index]==-1){
                $quest = new Question;
                $quest->question = $question;
                $quest->survey_id = $survey_id;
                $quest->question_type = $types[$index];
                $quest->save();
            }
            else{
                $quest = Question::find($ids[$index]);
                if($quest->question != $question){
                    $quest->question = $question;
                    $quest->save();
                }
            }
        }

        $survey = Survey::find($survey_id);

        $Form = $request->validate([
            'title' => 'required',
        ]);

        $survey->points=$pointTotal;
        $survey->title = $Form['title'];
        $survey->save();

        return Redirect::to('/survey/manage');
    }

    function OpenSurvey($survey_id){
        $survey = Survey::find($survey_id);
        $user = Auth::user();
        if($user->points > $survey->points){
            $survey->open = 1;
            $survey->save();
        }
        return Redirect::to('/survey/manage');
    }

    function CloseSurvey($survey_id){
        $survey = Survey::find($survey_id);
        $survey->open = 0;
        $survey->save();
        return Redirect::to('/survey/manage');
    }

    function AnalyzeSurvey($survey_id){
        $survey = Survey::all()->where("id", $survey_id)->first();
        $questions = Question::all()->where("survey_id", $survey_id);
        // $answer = Answer::whereIn('question_id', $questions->pluck('id'))->get();
        $answer = Answer::all()->where("survey_id", $survey_id);
        return view('AnalyzeSurvey', ["survey"=>$survey, "questions"=>$questions, "answer"=>$answer]);
    }

    function DeleteSurvey($survey_id){
        $survey = Survey::find($survey_id);
        $user = Auth::user();
        if($user->id == $survey->user_id){
            $survey->delete();
        }
        return Redirect::to('/survey/manage');
    }
}
