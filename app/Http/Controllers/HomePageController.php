<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Survey;
use App\Models\Answer;
use Auth;

class HomePageController extends Controller
{
    public function homepage () {
        $ownSurveys = Survey::all()->where("user_id", Auth::user()->id);
        $otherSurveys = Survey::all()
            ->where("user_id" ,"!=", Auth::user()->id)
            ->where("open",1)
            ->whereNotIn('id', Question::find( 
                Answer::all()
                ->where("user_id", Auth::user()->id)
                ->pluck("question_id")
            )->pluck('survey_id')->toArray());
        return view('dashboard',['ownSurveys' => $ownSurveys, 'user' => Auth::user(), 'otherSurveys' => $otherSurveys]);
    }
}
