<?php

class FeedController extends BaseController {
	public function feed()
	{
		if(Auth::check()){
			$user = Auth::user();
			$titlePage = "Timestamp";
			$recent_posts = Post::orderBy('created_at', 'desc')->get();
			$top_posts = Post::orderBy('like_count', 'desc')->orderBy('created_at', 'desc')->take(10)->get();
			$path_to_users = "users";
			$username = $user->username;
			$userId = $user->id;
			$user_path_profile = "users/$username$userId";
			$user_image_name = $username.'image001.jpg';
			$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
			
			
			return View::make('interfaces.feed')->with('user', $user)->with('recent_posts', $recent_posts)->with('titlePage', $titlePage)->with('top_posts', $top_posts)->with('user_profile_img', $user_profile_img);
		} else{
			return Redirect::to('/');
		}
	}
}