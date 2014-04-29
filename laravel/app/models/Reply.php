<?php

class Reply extends Eloquent
{
	protected $table = 'replies';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function post()
	{
		return $this->belongsTo('Post');
	}
	public function user_info(){
		$user = User::where('id', '=', $this->user_id)->first();
		return $user;
	}
}