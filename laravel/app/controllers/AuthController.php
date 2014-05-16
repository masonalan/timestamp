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
		} else {
			$user = new User;
			$user->username = $username;
			$user->email = $email;
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::action('HomeController@start');
		}
	}
	public function handleLogin()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		if (Auth::attempt(array('email' => $email, 'password' => $password)))
		{
			$user = Auth::user();
			$log_count = $user->login_countl;
			$user->login_count = $log_count + 1;
			$user->save();
			$username = $user->username;
			$userId = $user->id;
			$path_to_users = "users";
			$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
			$user_banner_img = 'users/'.$username.$userId.'/'.$username.'banner001.jpg';
			$user_path_profile = "users/$username$userId";
			if(!file_exists($user_path_profile)){
				mkdir($user_path_profile);
				copy('prof.jpg', $user_profile_img);
				copy('background-n.jpg', $user_banner_img);
				if ($log_count < 8) {
					return Redirect::action('HelpController@helper_new');
				} else{
				return Redirect::action('FeedController@feed');
				}
			} else {
				return Redirect::action('FeedController@feed');
			}
		} else {
			if (Auth::attempt(array('username' => $email, 'password' => $password)))
			{
				$user = Auth::user();
				$log_count = $user->login_count;
				$user->login_count = $log_count + 1;
				$user->save();
				$username = $user->username;
				$userId = $user->id;
				$path_to_users = "users";
				$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
				$user_path_profile = "users/$username$userId";
				$user_banner_img = 'users/'.$username.$userId.'/'.$username.'banner001.jpg';
				if(!file_exists($user_path_profile)){
					mkdir($user_path_profile);
					copy('prof.jpg', $user_profile_img);
					copy('background-n.jpg', $user_banner_img);
					if ($log_count < 8) {
						return Redirect::action('HelpController@helper_new');
					} else{
						return Redirect::action('FeedController@feed');
					}
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