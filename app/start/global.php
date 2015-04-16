<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/library',
    app_path().'/presenters'

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

App::error(function(ModelNotFoundException $e)
{

    return View::make('layouts.main')->nest('content', 'errors.modelNotFound');
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';


/*
 * ------------------------------------------------------------------------
 * View Composers
 * ------------------------------------------------------------------------
 */

require app_path().'/composers.php';


/*
 * ------------------------------------------------------------------------
 * Events
 * ------------------------------------------------------------------------
 */

require app_path().'/events.php';

/*
 * ------------------------------------------------------------------------
 * Set Session For Hardware & Cookie For Locale
 * ------------------------------------------------------------------------
 * 
 * Using Laravel-Agent, we figure out what sort of device a visitor is using.
 * We also check to see if a preferred language has been chosen and stored
 * in a cookie. If not, we check the languages accepted by the browser and
 * use App::setLocale to set it to something acceptable, defaulting to French
 * before English.
 * 
 */
	if(!Session::has('hardware'))
	{
		if(Agent::isMobile())
		{
			if(Agent::isTablet()) {
				Session::put('hardware', 'tablet');
			}
			else
			{
				Session::put('hardware', 'phone');
			}
			
		}
		else
		{
			
				Session::put('hardware', 'desktop');
		}
		
	}

	if(!Session::get('language'))
	{
		if(!Cookie::get('language'))
		{	
			$languages = Agent::languages();
			
			$accepted = array();
			
			foreach($languages as $l)
			{
				$bits = explode('-', $l);
				$accepted[] = $bits[0];
					
			}
				
			$appLocale = App::getLocale();

			if(in_array($appLocale, $accepted))
			{
				Cookie::forever('language', $appLocale);
				Session::put('language', $appLocale);
				App::setLocale($appLocale);
			}
			else
			{
				Cookie::forever('language', 'en');
				Session::put('language', 'en');
				App::setLocale('en');
					
			}
			
		}
		else
		{
			$appLocale = Cookie::get('language');
			Session::put('language', $appLocale);
			App::setLocale($appLocale);
			
		}
	}
	else
	{
		$appLocale = Session::get('language');
		Cookie::forever('language', $appLocale);
		App::setLocale($appLocale);
		
	}		

