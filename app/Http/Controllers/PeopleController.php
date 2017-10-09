<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PeopleController extends Controller
{
    public function people()
    {
    	$peoples = User::all();
    	//return view('people.index')->withPeoples($peoples);

    	return response()->json($peoples);
    }
}
