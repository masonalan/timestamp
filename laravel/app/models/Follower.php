<?php

class Follower extends Eloquent
{
	public function user()
	{
		return $this->belongsTo('User');
	}
}