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

Route::get('test', function()
{
$hash1 = Hash::make('1234'); // A hash is generated
$hash2 = Hash::make('1234'); // Another hash is generated that differs from the first one

var_dump(Hash::check('1234', $hash1) && Hash::check('1234', $hash2));

$user = Account::where('email', '=', 'alex@distributiondude.com')->firstOrFail();

/*$pass = Hash::make('kr4K3n');

$user->password = $pass;

$user->save();*/

echo '<br /><br />';

var_dump(Hash::check('sherbet', $user->password));


echo '<br />'.$user->password.'<br />';


var_dump($user);

});

Route::controller('account', 'AccountController');

//Route::controller('test', 'TestController');

//Route::get('search/{q?}', 'SearchController@getIndex');

Route::controller('search', 'SearchController');

Route::controller('catalogue', 'CatalogueController');

Route::controller('password', 'RemindersController');

Route::controller('reminders', 'RemindersController');

Route::resource('product', 'ProductController');

Route::resource('category', 'CategoryController');

Route::resource('productline', 'ProductlineController');

Route::get('manufacturer/dice/{id}', 'ManufacturerController@dice');
Route::resource('manufacturer', 'ManufacturerController');

