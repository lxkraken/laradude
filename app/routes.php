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

/*Route::get('/', function()
{
	return View::make('home');
});*/

Route::get('/', function()
{
	return View::make('layouts.main')->nest('content', 'home');
});

Route::get('/fcat', function()
{
	return View::make('layouts.main')->nest('content', 'catalogue.fcat');
});

Route::get('/ecat', function()
{
	return View::make('layouts.main')->nest('content', 'catalogue.ecat');
});

Route::get('/productlines', function()
{
	return View::make('layouts.main')->nest('content', 'catalogue.productlines');
});

/*Route::get('/product', function()
{
	return View::make('layouts.main')->nest('content', 'catalogue.product');
});*/

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


/*Route::get('/catalogue', function()
{
	$lang = 'f';
	//$data = DB::select('select distinct cat_id from product_lines pl join products p using (pl_id) where p.prod_lang = ? or p.prod_lang = \'m\'', array($lang));
	
	$data = DB::table('product_lines')
				->join('products', function($join)
				{
					$join->on('product_lines.pl_id', '=', 'products.pl_id')
						  ->where('products.prod_lang', '=', 'f')
						  ->orWhere('products.prod_lang', '=', 'm');
				})
				->select('product_lines.cat_id')
				->distinct()
				->get();
				
	
	
	foreach($data as $d) $catId[] = $d->cat_id;
	
	//return View::make('layouts.main')->nest('content', 'catalogue.fcat', $categories);
	
	return var_dump($catId);
});*/

//Route::controller('accounts', 'AccountsController');

Route::controller('catalogue', 'CatalogueController');

Route::controller('reminders', 'RemindersController');

Route::resource('product', 'ProductController');

