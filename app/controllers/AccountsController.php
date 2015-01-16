<?php

class AccountsController extends BaseController {

	protected $layout = 'layouts.main';

	public function getLogin() {
		$this->layout->content = View::make('accounts.login');
	}
	
	public function postSignin() {
		
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
			return Redirect::to('accounts/dashboard')->with('message', 'You are now logged in!');
		} else {
			return Redirect::to('accounts/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
		
	}

}
