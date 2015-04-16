<?php

class NavBar {
	
	protected $data;
	protected $account;
	
	public function __construct(Account $account)
	{
		$this->account = $account;

		
	}
	
	public function generateUserQuantities()
	{
		$basket = new Basket($this->account);
		$preorder = new Preorder($this->account);
		
		$this->data['basket'] = $basket->getSubtotal();
		$this->data['reserve'] = $preorder->getNumberOfItems();
		
		$this->getUsername();
		
		return $this->data;
		
	}
	
	public function generateAdminQuantities()
	{
		$basket = new Basket($this->account);
		
		$this->data['titetete'] = $basket->getNumberOfItems();
		
		$this->getUsername();
		
		return $this->data;
	}

	
////////////////////////////////////////////////

	private function getUsername()
	{
		$this->data['linkUrl'] = '/account/dashboard';
		$this->data['linkText'] = Lang::get('navigation.hello').' '.$this->account->username.'!';
		
	}

}
