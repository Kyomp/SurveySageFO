<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    function homepage(){
        return redirect()->route('register');
    }
}
