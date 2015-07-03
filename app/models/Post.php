<?php 

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Post extends Eloquent implements UserInterface, RemindableInterface
{
	public function getRememberToken()
	{
	    return $this->remember_token;
	}
	public function tags()
	{
		return $this->belongsToMany('Tag');
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}
	protected $table = 'posts';
	public function post_id()
	{
		return $this->id;
	}
	public function location()
	{
		return $this->belongsTo('Location');
	}

	public function user(){
		return $this->belongsTo('User');
	}
	public function user_info(){
		$user = User::where('id', '=', $this->user_id)->first();
		return $user;
	}
	public function likes(){
		return $this->hasMany('Like');
	}
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	public function getAuthPassword()
	{
		return $this->password;
	}

	public function countLikes()
	{
		$counter = 0;
		foreach ($this->likes as $like) {
			$counter = $counter + 1;
		}
		return $counter;
	}

	public function username()
	{
		$user = User::where('id', '=', $this->user_id)->first();
		return $user->username;
	}
	public function user_id()
	{
		$user = User::where('id', '=', $this->user_id)->first();
		return $user->id;
	}


	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	#public $timestamps = false;

	public function replies()
	{
		return $this->hasMany('Reply');
	}
	public function likers()
	{
		$final = '';
		$counter = '';
		$likes = Like::where('post_id', '=', $this->id)->orderBy('id', 'random')->get();
		foreach($likes as $name) {
			$liker = User::find($name->user_id);
			$almost = $liker->username.' likes this&#13;';
			$final = $final.$almost;
			$counter = $counter++;
		}

		return $final;
	}
}
