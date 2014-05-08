<?php
// For 404 errors:
App::missing(function($exception) {
	return Redirect::to('/');
});