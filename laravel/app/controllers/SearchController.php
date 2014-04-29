<?php
class SearchController extends BaseController {
	public function search($query){
			$user = Auth::user();
			$user_id = $user->id;
			$userProf = User::find($user_id);
			$username = $user->username;
			$user_path_profile = "users/$username$user_id";
			$user_image_name = $username.'image001.jpg';
			$user_profile_img = 'users/'.$username.$user_id.'/'.$username.'image001.jpg';
			$titlePage = "$query";
			return View::make('interfaces/search')->with('titlePage', $titlePage)->with('user', $user)->with('user_profile_img', $user_profile_img)->with('userProf', $userProf);
		}
	public function handleSearch(){
		$userInput = Input::get('search');
		$found = User::where('first_name', 'like', '%'.$userInput.'%')->get();
		return Redirect::to('search/'.$userInput);
	}
}