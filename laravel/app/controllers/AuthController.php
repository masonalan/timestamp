<?php

class AuthController extends BaseController {
	public function handleRegister()
	{
		$username = Input::get('name');
		$email = Input::get('email');

		$user_username = User::where('username', '=', $username)->first();	
		$email_username = User::where('email', '=', $email)->first();
		
		if (isset($user_username->id)) {
			return 'error:Username taken!';
		}
		if (isset($email_username->id)) {
			return 'error:Email taken!';
		}
		$user = new User;
		$user->username = $username;
		$user->email = $email;
		$user->password = Hash::make(Input::get('password'));
		$user->save();
		return Redirect::to('/');
	}
	public function handleLogin()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		if (Auth::attempt(array('email' => $email, 'password' => $password)))
		{
			$user = Auth::user();
				$username = $user->username;
				$userId = $user->id;
				$path_to_users = "users";
				$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
				$user_path_profile = "users/$username$userId";
			if(!file_exists($user_path_profile)){
				mkdir('users');
				mkdir($user_path_profile);
				copy('prof.jpg', $user_profile_img);
				return Redirect::action('FeedController@feed');
			} else {
				return Redirect::action('FeedController@feed');
			}
		} else {
			if (Auth::attempt(array('username' => $email, 'password' => $password)))
			{
				mkdir('users');
				$user = Auth::user();
				$username = $user->username;
				$userId = $user->id;
				$path_to_users = "users";
				$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
				$user_path_profile = "users/$username$userId";
				if(!file_exists($user_path_profile)){
					mkdir($user_path_profile);
					copy('prof.jpg', $user_profile_img);
					return Redirect::action('FeedController@feed');
				} else {
					return Redirect::action('FeedController@feed');
				}
			}
			return Redirect::action('AuthController@failed');
		}
	}
	public function failed()
	{
		return View::make('auth/failed');
	}
	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}