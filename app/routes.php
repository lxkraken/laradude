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

Route::get('sandbox', function()
{
	return View::make('jssandbox');

});

Route::get('baskettest', function()
{
	$account = Account::findOrFail('I5CgVjhBn2RRV1Ir');
	
	$product = Product::findOrFail('BBEPF10');
						 
	$preorder = new Preorder($account);
	$preorder->updateItem($product, $qty);
	
	//$product = Product::findOrFail('BBEPF11');
	
	
		

	
	echo '<br /><br />'.$preorder->getNumberOfItems().'<br /><br />'.$preorder->inPreorder($product);
	
	/*$account = DB::table('accounts')
				->where('account_id', '=', 'VZg8N2d1Q3UUf1py')
				->get();*/
	
	//$account = Account::find('VZg8N2d1Q3UUf1py');

	/*$oh = new OrderHelper;
	
	$order = Order::Accountid($account->account_id)->notsubmitted()->notsent()->first();
	
	$items = $oh->getItems($order);
	
	$noi = $oh->getNumberOfItems($order);
	
	$product = Product::findOrFail('UBIMU01');
	
	$oh->updateItem($product, 5, 0, $order);*/
	
	//$basket = new Basket($account);
	
	//$items = $basket->getItems();
	
	//$product = Product::findOrFail('UBIMU01');
	
	//$basket->updateItem($product, 5);
	
	
	
	//var_dump($items);

	/*foreach($items as $i)
	{
		echo $i->code.' '.$i->qty.'<br />';
	}*/
	
	//echo '<br /><br />A total of $'.$basket->getSubtotal();
	/*$o = $order->getBasket();
	
	echo $account->account_id;*/
	
	/*$queries = DB::getQueryLog();
	$result = end($queries);
	
	var_dump($result);*/
	

	
	//$order = Order::Accountid($account->account_id);
	
	//echo 'ordered_items_'.substr($o->order_id, 0, 6);
	
	/*foreach($order as $o)
	{
		echo $o->order_id;
	}*/
	
	//echo '<br /><br />'.$b->order_id;
	
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

Route::controller('basket', 'BasketController');


Route::controller('account', 'AccountController');

Route::controller('order', 'OrderController');

Route::controller('preorder', 'PreorderController');

//Route::controller('test', '\App\Controllers\TestController');

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

