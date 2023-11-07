<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use Auth;

class HomePageController extends Controller
{
    function homepage () {
        $ownSurveys = Survey::where('id', Auth::user()->id);
        echo $ownSurveys->id;
        
        return view('dashboard',['ownSurveys' => $ownSurveys]);
    }
}
