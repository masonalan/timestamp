<?php

class HelpController extends BaseController {
	public function helper_new()
	{
		return View::make('interfaces/help/new');
	}
}