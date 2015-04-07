<?php

class OrderController extends BaseController {

	protected $layout = 'layouts.main';
	protected $rank;
	protected $data;
	protected $account;
	
	public function __construct() {
		
		if(Auth::check())
		{
			$this->account = Account::findOrFail(Auth::id());
			$this->rank = $this->account->rank;
		}
		else
		{
			$this->rank = 0;
			$this->account = null;
		}

	}

	public function getIndex() {
				
		$basket = new Basket($this->account);
			
		$items = $basket->getBasket();
			
			
			
		if(count($items) > 0)
		{
			$oip = new OrderedItemsPresenter($items);
			$this->data['items'] = $oip->getOrderedItems();
		}
			
		$this->layout->content = View::make('orders.basket', $this->data);
		

	}
	
	public function getRemove($code = '', $order = '')
	{
		
		return (strlen($order) > 1) ? $order : 'crap';
	}
	

	
}
