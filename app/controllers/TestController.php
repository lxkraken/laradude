<?php

class TestController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	
	public function getManid()
	{
		$manufacturers = DB::table('manufacturers')
					->join('productlines', 'productlines.manId', '=', 'manufacturers.manId')
					->join('products', 'productlines.plId', '=', 'products.plId')
					->select('manufacturers.manId', 'productlines.plId')
					->orderBy('manufacturers.name', 'ASC')
					->get();
					
		return var_dump($manufacturers);
		
		
	}

}
