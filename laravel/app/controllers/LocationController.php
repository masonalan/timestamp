<?php
class LocationController extends BaseController {
	
	public function location_list($id){
		$post = Post::find($id);
		$ip = $post->ip_address;

		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		$place = "$details->city $details->region, $details->country";
		$location_match = Location::where('location', '=', $place)->get();
		$location_match_ip = Location::where('location', '=', $place)->get();
		$titlePage = "$place";
		$user = Auth::user();
		return View::make('interfaces.locfocus')
			->with('titlePage', $titlePage)
			->with('place', $place)
			->with('location_match', $location_match)
			->with('user', $user);
	}
}