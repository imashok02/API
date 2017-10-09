<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use App\User;
use App\Question;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

       // return view('Categories.index')->withCategories($categories);
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255'
            ));

        $category = new Category;
        $category->name = $request->name;

        $category->save();

        Session::flash('Success', 'Category added');

        return redirect()->route('categories.index');

        return response()->json($category);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          
    
        $category = Category::find($id);
       
       
        //return $question;
       // return view('questions.show')->withQuestion($question)->withUser($user)->withCategories($categories);

        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
          $this->validate($request, array(
            'name' => 'required|max:255'
            ));

        $category = Category::find($id);
        $category->name = $request->name;

        $category->save();

        return response()->json([$category]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $category = Category::find($id);
        $category->delete();

        return response()->json('Deleted Successfully!');

    }


   // Questions for a particular category

     public function Category($category_id)
    {
        $category = Category::find($category_id);
        if($category !== null){
            $questions = $category->questions;

             return response()->json($questions);

            }
        }

}
