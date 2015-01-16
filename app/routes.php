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

Route::get('assets', function()
{
	return View::make('assets');
});

Route::get('users', function()
{
	
	$accounts = Account::all();
	
    return View::make('accounts')->with('accounts', $accounts);
});

Route::controller('accounts', 'AccountsController');

Route::controller('reminders', 'RemindersController');

