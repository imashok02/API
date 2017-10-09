<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//function () use ($router) {
 //   return $router->app->version();

	// Login Routes

	$router->post('login/','AuthenticateController@authenticate');
	$router->post('register/','AuthenticateController@register');
	$router->get('logout/','AuthenticateController@logout');


	$router->group(['middleware' => 'auth:api'], function ($router) {


	//Home $routers
	
	$router->get('/', 'HomeController@index');

	//Answer $route for questions

	$router->post('/answers/{question_id}', ['uses'=>'AnswersController@store', 'as'=>'answers.store']);

	//Questions $routers     
	$router->get('/questions', 'QuestionsController@index');
	$router->get('/questions/create', 'QuestionsController@create');
	$router->post('/questions', 'QuestionsController@store');
	$router->get('/questions/{question}', 'QuestionsController@show');
	$router->post('/questions/{question}', 'QuestionsController@update');
	$router->delete('/questions/{question}', 'QuestionsController@destroy');
	$router->get('/questions/{question}/edit', 'QuestionsController@edit');

//Category routes

	$router->get('/categories', 'CategoryController@index');
	//$router->get('/categories/create', 'CategoryController@create');
	$router->post('/categories', 'CategoryController@store');
	$router->get('/categories/{category}', 'CategoryController@show');
	$router->post('/categories/{category}', 'CategoryController@update');
	$router->delete('/categories/{category}', 'CategoryController@destroy');
	$router->get('/categories/{category}/edit', 'CategoryController@edit');


	$router->get('/category/{category}', 'CategoryController@category');


			

// Search Controller
	 $router->get('/search', ['as' => 'search','uses' => 'SearchController@search']);

	 $router->get('/explore', 'ExploreController@explore');

	//User Profile $routers

	 $router->get('/people' ,[ 'as'=>'people', 'uses'=>'PeopleController@people']);

	 $router->get('/following',['as' => 'following','uses'=> 'ProfileController@following'] );

	 $router->get('/-{username}',['as' =>'profile', 'uses'=>  'ProfileController@show' ]);

	 $router->get('/-{username}/followers',['as'=>'followers', 'uses'=> 'ProfileController@followers'] );

	 $router->get('/-{username}/edit',['as'=>'profile.edit', 'uses'=>'ProfileController@edit'] );

	//User Follows

	 $router->get('/follows/{username}', 'UserController@follows');

	 $router->get('/unfollows/{username}', 'UserController@unfollows');

	
});

	


 



  


