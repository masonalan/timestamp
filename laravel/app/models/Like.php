<?php 

class Like extends Eloquent
{
	public function post()
	{
		return $this->belongsTo('Post');
	}

	public function username()
	{
		$liker = $like->user_id;
		$liker_name = User::find($liker);
		$name = $liker_name->username();
		return $name;
	}
}