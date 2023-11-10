<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PointsController extends Controller
{
    public function pointpage(){
        return view("points", ["points" => Auth::user()->points]);
    }

    public function exchangePoints($number){
        $user = Auth::user();
        if($user->points > $number){
            $user->points-=$number;
            $user->save();
            return Redirect::to("points");
        }
        $urls = ["https://www.mcdonalds.com/us/en-us/mcdonalds-careers.html", "https://www.youtube.com/watch?v=_IrQHeDcMi8","https://www.amazon.com/Coleman-2-Person-Sundome-Tent-Navy/dp/B014LSDUA8/ref=sr_1_4?crid=2MZAR9UW478TI&keywords=tent&qid=1699631884&sprefix=%2Caps%2C322&sr=8-4&th=1","https://www.youtube.com/watch?v=4JsgrXyBZO0","https://www.youtube.com/watch?v=ElG5-nXD0B8","https://www.youtube.com/shorts/teHvB-EWOlo","https://www.youtube.com/shorts/GXi3g0Td1Ig", "https://www.youtube.com/watch?v=0byKD-4iFn0"];
        return redirect()->away($urls[array_rand($urls)]);
    }
}
