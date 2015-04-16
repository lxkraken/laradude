<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('layouts.main')->nest('content', 'home');
});

Route::get('image', function()
{
    $img = Image::canvas(800, 600, '#ff0000');

    return $img->response();
});

Route::get('forget', function()
{
    Cookie::forget('language');
    Session::forget('language');
    
    echo 'All gone...';
    
    
	$languages = Agent::languages();
			
	foreach($languages as $l)
	{
		$bits = explode('-', $l);
		$accepted[] = $bits[0];
				
	}
			
	$appLocale = App::getLocale();
	
	if(in_array($appLocale, $accepted)) echo $appLocale.' is in the $accepted array.';
});




Route::get('agent', function()
{
	$languages = Agent::languages();
	
	echo (Agent::isDesktop()) ? 'Desktop' : 'Not a desktop';

	echo '<br />';
		
	echo (Agent::isMobile()) ? 'Mobile' : 'Not Mobile';
	
	echo '<br />';
		
	echo (Agent::isTablet()) ? 'Tablet' : 'Not Tablet';
	
	if(Agent::isMobile()) echo Agent::device().'<br />';
	
	echo '<br />';
	
	echo Agent::browser().'<br />';
	
	
	var_dump($languages);
	
	Cookie::forever('Washington', 'wins');
	
	if(Cookie::get('language')) Cookie::forget('language');
	if(Session::has('language')) Session::forget('language');
	
	if(!Session::has('language'))
	{

		if(!Cookie::get('language'))
		{	
			$languages = Agent::languages();
			
			foreach($languages as $l)
			{
				$bits = explode('-', $l);
				$accepted[] = $bits[0];
				
			}
			
			$appLocale = App::getLocale();

			if(in_array($appLocale, $accepted))
			{
				Session::set('language', $appLocale);
				Cookie::forever('language', $appLocale);
			}
			else
			{
				Session::set('language', 'en');
				Cookie::forever('language', 'en');
				
			}
		
		}
		else
		{
			Session::set('language', Cookie::get('language'));
		}
		
	}
	
	
});


Route::get('assets', function()
{
	return View::make('assets');
});

Route::get('users', function()
{
	
	$accounts = Account::all();
	
    return View::make('accounts')->with('accounts', $accounts);
});


Route::get('catalogue/{lang?}', 'CatalogueController@getIndex');

/*Route::get('search/{q?}', function($q='ass'){
	
	$s = new Search($q);
	
	$result = $s->getSearchResults();
	//$result = $s->l4Search();
	$queries = DB::getQueryLog();
	//$result = end($queries);*/
	
	/*foreach($result as $r)
	{
		var_dump($r->code).'<br/><br/>';
	}*/
	
	/*return var_dump($result);
	
});*/

Route::get('sandbox', function()
{
		$plIds = DB::table('productlines')
			->whereNotIn('pl_id', function($query)
			{
				$query->select(DB::raw('pl_id'))
					  ->from('products');

			})
			->select('pl_id')
			->get();
			
		foreach($plIds as $plId)
		{
			$p[] = $plId->pl_id;
		}		
		
		$plObj = Productline::findMany($p);
		
		var_dump($plObj);

	
});

//Settings: show form to create settings
//Settings: show form to create settings


//Settings: show form to create settings
/*Route::get( '/basket', array(
    'as' => 'basket.index',
    'uses' => 'BasketController@index'
) );*/
 
//Settings: create a new setting
Route::post( '/basket', array(
    'as' => 'basket.update',
    'uses' => 'BasketController@update'
) );


Route::post( '/ajax', array(
    'as' => 'ajax.update',
    'uses' => 'AjaxController@update'
) );

Route::get('/language/{appLocale}', function($appLocale)
{
	Cookie::forget('language');
	//Cookie::forever('language', $appLocale);
	App::setLocale($appLocale);
	Session::put('language', $appLocale);
	
	return Redirect::back();
	
});

Route::controller('basket', 'BasketController');

Route::controller('account', 'AccountController');

Route::controller('order', 'OrderController');

Route::controller('preorder', 'PreorderController');

Route::controller('search', 'SearchController');

Route::controller('catalogue', 'CatalogueController');

Route::controller('password', 'RemindersController');

Route::controller('reminders', 'RemindersController');

Route::resource('product', 'ProductController');

Route::resource('category', 'CategoryController');




Route::resource('productline', 'ProductlineController');

Route::get('manufacturer/dice/{id}', 'ManufacturerController@dice');
Route::resource('manufacturer', 'ManufacturerController');

