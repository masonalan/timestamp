<?php
class SearchController extends BaseController {
	public function search($type, $query){
			$user = Auth::user();
			$user_id = $user->id;
			$userProf = User::find($user_id);
			$username = $user->username;
			$user_path_profile = "users/$username$user_id";
			$user_image_name = $username.'image001.jpg';
			$user_profile_img = 'users/'.$username.$user_id.'/'.$username.'image001.jpg';
			$titlePage = "$query";
			$location_search = '_';
			if ($type == 'location') {
				$found = Location::where('location', 'like', '%'.$query.'%')->get();
				return View::make('interfaces/locsearch')
					->with('titlePage', $titlePage)->with('user', $user)
					->with('user_profile_img', $user_profile_img)
					->with('userProf', $userProf)
					->with('found', $found)
					->with('query', $query);
			} elseif ($type == 'post') {
				$found = Post::where('content', 'like', '%'.$query.'%')->orderBy('id', 'desc')->get();
				return View::make('interfaces/psearch')
					->with('titlePage', $titlePage)->with('user', $user)
					->with('user_profile_img', $user_profile_img)
					->with('userProf', $userProf)
					->with('found', $found)
					->with('query', $query);
			} elseif ($type == 'tag') {
				$found = Post::where('content', 'like', '%'.$query.'%')->orderBy('id', 'desc')->get();
				return View::make('interfaces/hsearch')
					->with('titlePage', $titlePage)->with('user', $user)
					->with('user_profile_img', $user_profile_img)
					->with('userProf', $userProf)
					->with('found', $found)
					->with('query', $query);
			}
			else {
				$found = User::where('username', 'like', '%'.$query.'%')->get();
				return View::make('interfaces/search')
					->with('titlePage', $titlePage)->with('user', $user)
					->with('user_profile_img', $user_profile_img)
					->with('userProf', $userProf)
					->with('found', $found)
					->with('query', $query);
			}
			return View::make('interfaces/search')
				->with('titlePage', $titlePage)->with('user', $user)
				->with('user_profile_img', $user_profile_img)
				->with('userProf', $userProf)
				->with('found', $found)
				->with('query', $query);
		}
	public function handleSearch(){
		$userInput = Input::get('search');
		$userInput = ' '.$userInput;
		if (strrpos($userInput, '_') == 1) {
				$userInput = str_replace(' _', '', $userInput);
				$type = 'location';
		} 
		elseif (strrpos($userInput, '@') == 1) {
				$userInput = str_replace(' @', '', $userInput);
				$type = 'user';
		} 
		elseif (strrpos($userInput, '.') == 1) {
				$userInput = str_replace(' .', '', $userInput);
				$type = 'post';
		}
		elseif (strrpos($userInput, '#') == 1) {
				$userInput = str_replace(' #', '', $userInput);
				$type = 'tag';
		} else{
			$userInput = str_replace(' ', '', $userInput);
			$type = 'user';
		}
		return Redirect::to('search/'.$type.'/'.$userInput);
	}
}