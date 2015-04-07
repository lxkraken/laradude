<?php

class Basket {

	// Data members
	//
	protected $oh;
	protected $account;
	protected $basket;



//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////
	public function __construct(Account $account) {
		
		$this->account = $account;
		
		$this->oh = new OrderHelper;
		
		$order = Order::Accountid($this->account->account_id)->notsubmitted()->notsent()->first();
		
		$this->basket = (count($order) < 1) ? $this->oh->createOrder($this->account) : $order;
	
	}



//////////////////////////////////////////////////////////////////
//public fuctions

	public function getBasket()
	{
		return $this->oh->getItems($this->basket);
		
	}
	
	public function getItems()
	{
		return $this->oh->getItems($this->basket);
		
	}
	
	public function getSubtotal()
	{
		return $this->oh->getSubtotal($this->basket);
		
	}

	public function getTaxes()
	{
		return $this->oh->getTaxes($this->basket, $this->account);
		
	}
	
	public function updateItem(Product $product, $qty, $extra_discount = 0)
	{
		return $this->oh->updateItem($product, $qty, $extra_discount, $this->basket);
	}
	
	public function getNumberOfItems()
	{
		return $this->oh->getNumberOfItems($this->basket);
	}
	
	public function inBasket(Product $product)
	{
		return $this->oh->inOrder($product, $this->basket);
	}

	



//////////////////////////////////////////////////////////////////
//private functions



}


?>
