<?php
class PostController extends BaseController {

	public function check()
	{
	$postimg_get = Input::get('postimg');
	$has_image = Input::get('has_image');
	$postimg = Input::file('post_img');
	$now = time();
	$five = 7 * 24 * 60 * 60;
	
	if($has_image == 'true'){
		if(file_exists('post_img')){
			$post = new Post;
			$post->user_id = Auth::user()->id;
			$post->content = Input::get('content');
			$post->like_count = 0;
			$post->image_id = 1;
			$post->image_class = Input::get('classes');
			$post->deleting_at = $now + $five;
			$post->ip_address = Request::getClientIp();
			$post->save();
			$location = new Location;
			$ip = Request::getClientIp();
			if($ip='::1'){
				$ip = '173.59.69.109';
			}
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			$location->location = "$details->city $details->region, $details->country";
			$location->post_id = $post->id;
			$location->save();

			$path_img = 'post_img/'.$post->id;
			mkdir($path_img);

			$postimg->move($path_img, $post->id.'image001.jpg');



		} else {
			$post = new Post;
			$post->user_id = Auth::user()->id;
			$post->content = Input::get('content');
			$post->like_count = 0;
			$post->image_id = 1;
			$post->image_classes = Input::get('classes');
			$post->deleting_at = $now + $five;
			$post->ip_address = Request::getClientIp();
			$post->save();
			$location = new Location;
			$ip = Request::getClientIp();
			if($ip='::1'){
				$ip = '173.59.69.109';
			}
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			$location->location = "$details->city $details->region, $details->country";
			$location->post_id = $post->id;
			$location->save();
			mkdir('post_img');
			$path_img = 'post_img/'.$post->id;
			mkdir($path_img);
			$postimg->move($path_img, $post->id.'image001.jpg');

		}
     }else {
     	$post = new Post;
		$post->user_id = Auth::user()->id;
		$post->content = Input::get('content');
		$post->like_count = 0;
		$post->image_id = 0;
		$post->deleting_at = $now + $five;
		$post->ip_address = Request::getClientIp();
		$post->save();
		$location = new Location;
		$ip = Request::getClientIp();
		if($ip='::1'){
			$ip = '173.59.69.109';
		}
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		$location->location = "$details->city $details->region, $details->country";
		$location->post_id = $post->id;
		$location->save();
		return Redirect::back();
     }
    return Redirect::back();
	}

	public function like() 
	{
		$user = Auth::user();
		$post_id = Input::get('post_id');
		$post = Post::where('id', '=', $post_id)->first();
		$has_liked = $user->hasLiked($post);
		$class = 'arrow-up';
		if (!$has_liked) {
			$like = new Like;
			$like->user_id = $user->id;
			$like->post_id = $post_id;
			$like->save();
			$class .= ' arrow-voted';
		}
		else {
			$like = Like::find($has_liked);
			$like->delete();
		}
		$post->like_count = $post->countLikes();
		$post->save();
		return $class;
	}

	public function reply(Post $post)
	{
		$user = Auth::user();
		$replyimg = Input::file('post_img');
		$has_image = Input::get('has_image');
		$reply = new Reply;
		$reply->content = Input::get('content');
		$reply->post_id = $post->id;
		$reply->user_id = $user->id;
		$reply->save();

		$has_image = Input::get('has_image');
		if(!empty($replyimg)){
			if(!file_exists('reply_img')){
				$reply->image_id = '1';
				$reply->save();
				mkdir('reply_img');
				$path_img = 'reply_img/'.$reply->id;
				mkdir($path_img);
				$replyimg->move($path_img, $reply->id.'reply001.jpg');
			} else {
				$reply->image_id = '1';
				$reply->save();
				$path_img = 'reply_img/'.$reply->id;
				mkdir($path_img);
				$replyimg->move($path_img, $reply->id.'reply001.jpg');
			}
		}
		return Redirect::back();
	}
	public function focus($id)
	{
		$post = Post::find($id);
		$post_id = $post->id;
		$titlePage = "{$post->username()}";
		$user = Auth::user();
		$location = Location::where('post_id', '=', $post->id)->get();
		#$place = $location->location;
		return View::make('interfaces.post')->with('titlePage', $titlePage)->with('post', $post)->with('user', $user);
	}


}