<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;


class ExploreController extends Controller
{
    public function explore()
    {


    	$medias = Question::with('user')->get();
    	
    	
    //	return view('Explore.media')->withMedias($medias);
    	return response()->json($medias);
    }
}
