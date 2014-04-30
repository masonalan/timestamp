<?php

class WorldController extends BaseController {
	public function world()
	{
		$titlePage = "World";
		return View::make('interfaces/world')->with('titlePage', $titlePage);
	}
}