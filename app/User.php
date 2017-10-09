<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Traits\Friendable;


class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    use Friendable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_key',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
    ];


   
     public function questions()
    {
        return $this->hasMany('App\Question');
    }


     public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'followers', 'follower_user_id', 'user_id')->withTimestamps();
    }
    /**
     * Does current user following this user?
     */
    public function isFollowing(User $user)
    {
        return !is_null($this->following()->where('user_id', $user->id)->first());
    }
    /**
     * The followers that belong to the user.
     */
    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_user_id')->withTimestamps();
    }

//use $user->Followingquestions()
    
    public function Followingquestions()
{
    $following = $this->following()->with(['questions' => function ($query) {
        $query->orderBy('created_at', 'desc');
    }])->get();

    // By default, the tweets will group by user.
    // [User1 => [Tweet1, Tweet2], User2 => [Tweet1]]
    //
    // The timeline needs the tweets without grouping.
    // Flatten the collection.
    $timeline = $following->flatMap(function ($values) {
        return $values->questions;
    });

    // Sort descending by the creation date
    $sorted = $timeline->sortByDesc(function ($card) {
        return $card->created_at;
    });

    return $sorted->values()->all();
}


}
