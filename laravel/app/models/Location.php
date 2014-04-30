<?php

class Location extends Eloquent
{
	protected $table = 'location';
	public $timestamps = false;
	
	public function post()
	{
		return $this->hasMany('Post');
	}
}