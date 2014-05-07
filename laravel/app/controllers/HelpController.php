<?php

class HelpController extends BaseController {
	public function helper_new()
	{
		$user = Auth::user();
		$titlePage = 'Help Desk';
		return View::make('interfaces/help/new')
			->with('titlePage', $titlePage)
			->with('user', $user);
	}
}