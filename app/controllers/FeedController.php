<?php

class FeedController extends BaseController {
	public function feed()
	{
		if(Auth::check()){
			$user = Auth::user();
			$titlePage = "Timestamp";
			$following = $user->following()->get();
			//trying to get the id and then use that in the foreach
			//this is for personalized feeds btw
			$following_id = '';
			$counter = 0;
			/*foreach($following as $f)
			{
				$counter = $counter + 1;

				$following_id = $following_id.$f->user_id.'.';
				$all_posts.$f->id = Post::where('user_id', '=', $f->id)->get();
				die(var_dump($all_posts.$f->id));

			}*/
			$test = explode('.', $following_id);
			$posts = Post::where('id', '>', '0')->get();
			$recent_posts = Post::orderBy('created_at', 'desc')->get();
			$top_posts = Post::orderBy('like_count', 'desc')->orderBy('created_at', 'desc')->take(30)->get();
			$path_to_users = "users";
			$username = $user->username;
			$userId = $user->id;
			$user_path_profile = "users/$username$userId";
			$user_image_name = $username.'image001.jpg';
			$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
			
			
			return View::make('interfaces.feed')
				->with('user', $user)->with('recent_posts', $recent_posts)
				->with('titlePage', $titlePage)
				->with('top_posts', $top_posts)
				->with('user_profile_img', $user_profile_img)
				->with('following', $following);
		} else{
			return Redirect::to('/');
		}
	}
}