<?php

class UserController extends BaseController {
	public function profile($user_id)
	{
		if(Auth::check()){
			$user = Auth::user();
			$userProf = User::find($user_id);
			return Redirect::to('/u/'.$userProf->username);

		} else{
			return Redirect::to('/');
		}
	}
	public function gui_prof($user_username)
	{
		if(Auth::check()){
			$user = Auth::user();
			$userProf = User::where('username', '=', $user_username)->first();
			$userId = $user->id;
			$path_to_users = "users";
			$username = $user->username;
			$user_path_profile = "users/$username$userId";
			$user_image_name = $username.'image001.jpg';
			$titlePage = $userProf->username;
			$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
			$follower = $userProf->followed()->take(5)->get();
			$following = $userProf->following()->take(5)->get();
			$recent_posts = Post::where('user_id', '=', $userProf->id)->orderBy('created_at', 'desc')->get();
			return View::make('interfaces/profile')
				->with('user', $user)
				->with('recent_posts', $recent_posts)
				->with('titlePage', $titlePage)
				->with('userProf', $userProf)
				->with('user_profile_img', $user_profile_img)
				->with('follower', $follower)
				->with('following', $following);
		} else{
			return Redirect::to('/');
		}
	}

	public function handleUpload()
	{
		$user = Auth::user();
		$username = $user->username;
		$userId = $user->id;
		$path_to_users = "users";
		$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
		$user_path_profile = "users/$username$userId";
		$user_image_name = $username.'image001.jpg';
		$file = Input::file('profile');
		if(file_exists($path_to_users))
		{
			if(file_exists("$user_path_profile")){
				$file->move("$user_path_profile/", $user_image_name);
			} else {
			mkdir("$user_path_profile");
				$file->move("$user_path_profile/", $user_image_name);
		}

		} else {
			mkdir("users");
			mkdir("$user_path_profile");
			$file->move("$user_path_profile/", $user_image_name);
		}
		return Redirect::to("profile/$user->id");
	}
	public function settings()
	{
		if(Auth::check()){
			$user = Auth::user();
			$user_id = $user->id;
			$path_to_users = "users";
			$username = $user->username;
			$user_path_profile = "users/$username$user_id";
			$user_image_name = $username.'image001.jpg';
			$user_profile_img = 'users/'.$username.$user_id.'/'.$username.'image001.jpg';
			$titlePage = $user->username;
			$recent_posts = Post::where('user_id', '=', $user_id)->orderBy('created_at', 'desc')->get();
			return View::make('interfaces/settings')->with('user', $user)->with('recent_posts', $recent_posts)->with('titlePage', $titlePage)->with('user_profile_img', $user_profile_img);
		} else{
			return Redirect::to('/');
		}
	}
	public function handleAbout()
	{
		$user = Auth::user();
		$about = Input::get('about');
		$user->about = $about;
		$user->save();
		return Redirect::to('settings');
	}
	public function handleFollow(){
		$user = Auth::user();
		$user_id = $user->id;
		$userProf = User::find($user_id);
		$follower = new Follow;
		$follower->follower = $user->id;
		$follower->followed = $userProf->id;
		return Redirect::to('profile/'.$userProf->id);

	}

	public function followUser($user_id)
	{

		$user = User::find($user_id);

		$currentUser = Auth::user();

		$follower = new Follower;
		$follower->user_id = $user->id;
		$follower->follower_user_id = $currentUser->id;
		$follower->save();

		return Redirect::back();
	}

	public function unfollowUser($user_id)
	{
		$user = User::find($user_id);

		$currentUser = Auth::user();

		$follower = Follower::where('user_id', '=', $user->id)->where('follower_user_id', '=', $currentUser->id);

		$follower->delete();

		return Redirect::back();
	}
	public function search(){
		$user = Auth::user();
		$user_id = $user->id;
		$userProf = User::find($user_id);
		$username = $user->username;
		$user_path_profile = "users/$username$user_id";
		$user_image_name = $username.'image001.jpg';
		$user_profile_img = 'users/'.$username.$user_id.'/'.$username.'image001.jpg';
		$titlePage = "Search";
		User::where('first_name', '%LIKE', $userInput)->get();
		return View::make('interfaces/search')->with('titlePage', $titlePage)->with('user', $user)->with('user_profile_img', $user_profile_img)->with('userProf', $userProf);
	}
	public function notfound(){
		$user = Auth::user();
		$titlePage = 'Error';
		return View::make('404')->with('user', $user)->with('titlePage', $titlePage);
	}
	public function handleDetails()
	{
		$user = Auth::user();
		$user->firstname = Input::get('firstname');
		$user->lastname = Input::get('lastname');
		$user->save();
		return Redirect::back();
	}
	public function back(){
		return Redirect::intended();
	}
	public function detailFollowers($id)
	{
		
		$user = Auth::user();
		$userProf = User::find($id);
		$info = $userProf->followed()->get();
		$info_check = $userProf->followed()->first();
		$titlePage = "$userProf->username - Followers";
		
		return View::make('interfaces.followers')
			->with('titlePage', $titlePage)
			->with('user', $user)
			->with('userProf', $userProf)
			->with('info_check', $info_check);;
	}
	public function detailFollowing($id)
	{
		$user = Auth::user();
		$userProf = User::find($id);
		$info_check = $userProf->following()->first();
		$info = $userProf->following()->get();
		$titlePage = "$userProf->username - Following";
		
		return View::make('interfaces.following')
			->with('titlePage', $titlePage)
			->with('user', $user)
			->with('userProf', $userProf)
			->with('info', $info)
			->with('info_check', $info_check);
	}
}