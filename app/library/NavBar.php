<?php

class NavBar {
	
	protected $data;
	
	public function generateUserQuantities()
	{
		
		$this->data['basket'] = $this->getBasket();
		$this->data['reserve'] = $this->getReserve();
		
		$this->getUsername();
		
		return $this->data;
		
	}
	
	public function generateAdminQuantities()
	{
		
		$this->data['titetete'] = $this->getTiteTete();
		
		$this->getUsername();
		
		return $this->data;
	}

	
////////////////////////////////////////////////

	private function getUsername()
	{
		$this->data['linkUrl'] = '/account/dashboard';
		$this->data['linkText'] = 'Salut '.Auth::user()->username.'!';
		
	}
	
	private function getBasket()
	{
		return 46;
	}
	
	private function getReserve()
	{
		return 94;
		
	}
	
	private function getTiteTete()
	{
		
		return 55;
	}

}
