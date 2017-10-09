<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Question;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 //   public function __construct()
   // {
     //   $this->middleware('api');
   // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $categories = Category::all();
       
     
        $questions =  Question::with('user','category')->get();
        
       // return view('home')->withCards($cards)->withUser($user)->withCategories($categories)->withQuestions($questions);

        return response()->json($questions);
    }
}


 