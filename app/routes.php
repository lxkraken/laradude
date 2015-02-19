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

Route::get('test', function(){
	
	$data['productline']['header_product'] = 'UBIZC01~UBIZC04';
	
	$pl['header_product'] = 'UBIZC01~UBIZC04';

		$baseProducts = Product::productline(255)->subproductline(0)->prodlang('f')->orderBy('prod_type')->orderBy('code')->display()->get();
				
		$baseProductsArray = $baseProducts->toArray();
		
		if($data['productline']['header_product'] == 0)
		{
			$data['products'] = $baseProductsArray;
			$data['header_product'] = 'none';
		}
		if($data['productline']['header_product'] == 1)
		{
			$data['header_product'] = array_shift($baseProductsArray);
			$data['products'] = $baseProductsArray;
			

		}
		else
		{
			
			unset($data['header_product']);
			$codes = explode('~', $pl['header_product']);
			
			foreach($baseProductsArray as $bpa)
			{
				
				if(in_array($bpa['code'], $codes))
				{
					$data['header_product'][] = $bpa;
					$res['good'][] = $bpa['code'];
				}
				else
				{
					$data['products'][] = $bpa;
					$res['ass'][] = $bpa;
				}
				
			}
		}
		
		return var_dump($res);
});

//Route::controller('accounts', 'AccountsController');

//Route::controller('test', 'TestController');

Route::controller('catalogue', 'CatalogueController');

Route::controller('reminders', 'RemindersController');

Route::resource('product', 'ProductController');

Route::resource('category', 'CategoryController');

Route::resource('productline', 'ProductlineController');

Route::get('manufacturer/dice/{id}', 'ManufacturerController@dice');
Route::resource('manufacturer', 'ManufacturerController');

