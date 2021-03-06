<?php

class AccountController extends BaseController {

	protected $layout = 'layouts.main';
	
	public function getIndex()
	{
		
		return Redirect::to('account/login');
	}

	public function getLogin() {
		$this->layout->content = View::make('accounts.login');
	}
	
	public function postSignin() {
		
		$remember = (Input::get('remember') == 1) ? true : false;
		
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), $remember)) {
			$user = Account::findOrFail(Auth::id());
			$response = Event::fire('auth.login', array($user));
			/*$user->last_login = date("Y-m-d H:i:s");
			$user->save();*/
			return Redirect::to('/account/dashboard');
		} else {
			return Redirect::to('/account/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
		
	}
	
	public function postLogout()
	{
		
		Auth::logout();
		return Redirect::to('/');
		
		
	}
	
	public function getDashboard()
	{
		$data['user'] = Account::findOrFail(Auth::id());
		
		if($data['user']->rank > 1)
		{
			$ah = new AdminHelper;
			
			$plObjs = $ah->productlinesNoProduct();
			
			if($plObjs) foreach($plObjs as $plObj)
			{
				$plp = new ProductlinePresenter($plObj, $data['user']);
				$productlines[] = $plp->getProductline();
			}
			
			$data['plNoProduct'] = $productlines;
			
			$this->layout->content = View::make('admin.dashboard', $data);
		}
		elseif($data['user']->rank == 1)
		{
			$this->layout->content = View::make('accounts.dashboard', $data);
		}
		else
		{
			return Redirect::to('account/login');
		}
		
	}

}
