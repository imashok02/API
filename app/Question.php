<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Answer;
use App\Category;


class Question extends Model
{
	 public function user()
   {
    return $this->belongsTo('App\User');
   }
   
    
   public function answers()
   {
   	return $this->hasMany('App\Answer');
   }

   public function category()
   {
   	return $this->belongsTo('App\Category');
   }


    public function qline()
{
    $following = $this->following()->with(['Questions' => function ($query) {
        $query->orderBy('created_at', 'desc');
    }])->get();

    // By default, the tweets will group by user.
    // [User1 => [Tweet1, Tweet2], User2 => [Tweet1]]
    //
    // The timeline needs the tweets without grouping.
    // Flatten the collection.
    $timeline = $following->flatMap(function ($values) {
        return $values->Questions;
    });

    // Sort descending by the creation date
    $sorted = $timeline->sortByDesc(function ($Questions) {
        return $Questions->created_at;
    });

    return $sorted->values()->all();
}

}