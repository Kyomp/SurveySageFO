<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use Auth;

class HomePageController extends Controller
{
    public function homepage () {
        $ownSurveys = Survey::all()->where("user_id", Auth::user()->id);
        $otherSurveys = Survey::all()->where("user_id" ,"!=", Auth::user()->id);
        return view('dashboard',['ownSurveys' => $ownSurveys, 'user' => Auth::user(), 'otherSurveys' => $otherSurveys]);
    }
}
