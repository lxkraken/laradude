<?php

View::composer('layouts.main', function($view)
{
	
	// Login chompy
	//if(!Auth::check()) Auth::loginUsingId('U56QkhcMF57MSjtz');
	
	//Login jesse
	//Auth::loginUsingId('9BaIEacG7l62lNTF');

	// Logout
	//Auth::logout();
	
	if(Auth::check())
	{
		$account = Account::findOrFail(Auth::id());
		
		$nb = new NavBar($account);
		
		if($account->rank > 1)
		{
			
			$nav = $nb->generateAdminQuantities();
			$nav['bottom'] = true;
		}
		else
		{
			
			$nav = $nb->generateUserQuantities();
		}
		
		// Update the last_activity timestamp
		
		$account->last_activity = new DateTime;
		$account->save();
		
	}
	else
	{
		$nav['linkText'] = Lang::get('navigation.login');
		$nav['linkUrl'] = '/account/login';
		
	}
	
	$view->with('nav', $nav);
	
});
