<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function notification()
	{
		return $this->hasMany("Notification");
	}

	public function posts(){
		return $this->hasMany('Post');
	}
	public function hasLiked($post)
	{
		$likes = Like::where('post_id', '=', $post->id)->get();
		//dd($likes);
		$id = $this->id;
		//dd($id);
		$has_liked = false;
		foreach ($likes as $like) {
			if ($id == $like->user_id) {
				$has_liked = $like->id;
				break;
			}
		}
		return $has_liked;
	}
	

	public function stampsCount()
	{
		$posts = Post::where('user_id', '=', $this->id)->get();
		$counter = 0;
		foreach ($posts as $post) {
			$counter += 1;
		}
		return $counter;
	}
	public function notificationCount()
	{
		$counter = 0;
		$notification = Notification::where('user_id', '=', $this->id)->where('viewed', '=', '0')->get();
		foreach ($notification as $count) {
			$counter = $counter + 1;
		}
		return $counter;
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
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

	public function followers()
	{
		return $this->hasMany('Follower');
	}

	/**
	* check to see if the 
	* current user follows the other
	* @param $obj type User
	* returns True if the current user DOES follow given user
	* returns False if the current user DOES NOT Follow given use
	*/
	public function follows(User $givenUser)
	{
		$currentUser = Auth::user();

		$follow = Follower::where('user_id', '=', $givenUser->id)->where('follower_user_id', '=', $currentUser->id)->first();

		if (empty($follow))
		{
			return False;
		}
		else
		{
			return True;
		}

	}

	/**
	* following
	* grabs all the people the user is following
	*
	*/

	public function following()
	{
		return Follower::where('follower_user_id', '=', $this->id);
	}

	/*
	Followed
	Grabs all people user is followed by
	*/
	public function followed()
	{
		return Follower::where('user_id', '=', $this->id);
	}
	public function username(){
		$user = User::where('id', '=', $this->user_id)->first();
		return $user->username;
	}
	
}