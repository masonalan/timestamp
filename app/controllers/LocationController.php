<?php
class LocationController extends BaseController {
	
	public function location_list($id){
		$location_match = Location::find($id);
		$ip = $location_match->ip_address;

		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		$place = "$details->city $details->region, $details->country";
		$posts = Post::where('location_id', '=', $location_match->id)->orderBy('id', 'desc')->get();
		$titlePage = "$place";
		$user = Auth::user();
		return View::make('interfaces.locfocus')
			->with('titlePage', $titlePage)
			->with('place', $place)
			->with('location_match', $location_match)
			->with('user', $user)
			->with('posts', $posts);
	}
}