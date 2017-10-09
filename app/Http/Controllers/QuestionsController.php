<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Question;
use App\Category;
use Session;
use App\User;
use Auth;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      
        $questions =  Question::with('user','category')->get();
       
        //$categories = Category::orderBy('name')->get();

      //  return view('questions.index')->withQuestions($questions)->withUser($user)->withCategories($categories)->withPop($pop);

        return response()->json($questions);
    }

    /**
     * Show the form for creating a new resource.
     *s
     * @return \Illuminate\Http\Response
     */
 
    public function create(Request $request)
    {
        
        $categories = Category::all(); 
        //return view('questions.create')->withCategories($categories);

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'title'=>'required|max:255',   
            ));

        $Question = new Question;
        $Question->user_id = Auth::user()->id;
        $Question->title = $request->title;
        $Question->description =  $request->description;
        $Question->category_id =$request->category_id;
        $Question->slug = str_slug($request->title,'-');
    
    
       
        $Question->save();
       
       // $Question->marks()->sync($request->marks,false);


       // Session::flash('Success', 'Thanks for your Question. Your Question has been Sticked!');

       // return redirect()->route('questions.show', [$Question->id]);

         return response()->json($Question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
          $user = User::find($id);
        $question = Question::find($id);
        $categories =Category::with('questions')->get();
       
        //return $question;
       // return view('questions.show')->withQuestion($question)->withUser($user)->withCategories($categories);

        return response()->json($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::all();
        $question = Question::find($id);
        $categories =Category::all();
        $cats = array();
         foreach ($categories as $category) {
             $cats[$category->id] = $category->name;
         }
       
        //return $question;
       // return view('questions.edit')->withQuestion($question)->withUser($user)->withCategories($cats);

         return response()->json([$questions, $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         $Question =Question::find($id);

     $this->validate($request,array(
            'title'=>'required|max:255',   
            ));
      


        $Question->user_id = Auth::user()->id;
        $Question->title = $request->title;
        $Question->category_id =$request->category_id;
        $Question->slug = str_slug($request->title,'-');
        $Question->save();
       
       // $Question->marks()->sync($request->marks,false);


       // Session::flash('Success',' Your Question has been Updated!');

       // return redirect()->route('questions.show', [$Question->id]);

         return response()->json($Question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();

        return response()->json('Deleted Successfully!');
    }

   
}
