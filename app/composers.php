<?php

View::composer('layouts.main', function($view)
{
	
	// Login chompy
	//if(!Auth::check()) Auth::loginUsingId('U56QkhcMF57MSjtz');
	
	//Login jesse
	//Auth::loginUsingId('9BaIEacG7l62lNTF');

	// Logout
	//Auth::logout();
	
	$nb = new NavBar();
	
	if(Auth::check())
	{
		if(Auth::user()->rank > 1)
		{
			
			$nav = $nb->generateAdminQuantities();
			$nav['bottom'] = true;
		}
		else
		{
			
			$nav = $nb->generateUserQuantities();
		}
	}
	else
	{
		$nav['linkText'] = 'Connexion';
		$nav['linkUrl'] = '/account/login';
		
	}


	$view->with('nav', $nav);
	
});
