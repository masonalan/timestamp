<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function splash()
	{
		if(Auth::check()){
			return Redirect::action('FeedController@feed');
		}
		return View::make('splash');
	}
	
	public function subscribe()
	{
		$subscriber = new Subscribe;
		$email = Input::get('email');
		$subscriber->email = $email;
		return Redirect::back();
	}

	public function start(){
		return View::make('auth/register');
	}

	
	

}