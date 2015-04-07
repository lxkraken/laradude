<?php

class Reserve {

	// Data members
	//
	protected $account;
	protected $reserve;



//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////
	public function __construct(Account $account) {
		
		$this->account = $account;
		
		$this->reserve = DB::table('reserve')
						 ->where('account_id', $this->account->account_id)
						 ->get();
	
	}



//////////////////////////////////////////////////////////////////
//public fuctions

	public function getReserve()
	{
		return $this->reserve;
		
	}
	
	public function getNumberOfItems()
	{
		
		$noi = 0;
		
		foreach($this->reserve as $item)
		{
			$noi += $item->qty;
		}
		return $noi;
		
	}

	public function updateItem(Product $product, $qty)
	{
		return $this->oh->updateItem($product, $qty, $extra_discount, $this->basket);
	}

	public function inReserve($code)
	{
		$item = DB::table('reserve')
				->where('account_id', '=', $this->account->account_id)
				->where('code', '=', $code)
				->select('qty')
				->first();
				
		return (count($item) > 0) ? $item->qty : 0;		
			
	}



//////////////////////////////////////////////////////////////////
//private functions



}


?>
