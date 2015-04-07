<?php

class Preorder {

	// Data members
	//
	protected $account;


//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////
	public function __construct(Account $account) {
		
		$this->account = $account;
	
	}



//////////////////////////////////////////////////////////////////
//public fuctions

	public function getPreorder()
	{
		
		$items = DB::table('preorders')
					->where('account_id', $this->account->account_id)
					->orderBy('code', 'ASC')
					->get();
		
		return $items;
		
	}
	
	public function getNumberOfItems()
	{
		$items = $this->getPreorder();
		
		$noi = 0;
		
		foreach($items as $item)
		{
			$noi += $item->qty;
		}
		return $noi;
		
	}

	public function inPreorder(Product $product)
	{
		$item = DB::table('preorders')
				->where('account_id', '=', $this->account->account_id)
				->where('code', '=', $product->code)
				->select('qty')
				->first();
				
		return (count($item) > 0) ? $item->qty : 0;		
			
	}
	
	public function updateItem(Product $product, $qty)
	{
		
		$inPreorder = $this->inPreorder($product);
		
		if($qty > 0)
		{
			if($inPreorder > 0)
			{
				DB::table('preorders')
					->where('account_id', $this->account->account_id)
					->where('code', $product->code)
					->update(['qty' => $qty]);
			}
			else
			{
				
				DB::table('preorders')->insert([
					'account_id' => $this->account->account_id,
					'code' => $product->code,
					'qty' => $qty,
					]);
					
			}
			
		}
		else
		{
			if($inPreorder > 0)	DB::table('preorders')
								->where('account_id', $this->account->account_id)
								->where('code', $product->code)
								->delete();

		}
		
	}



//////////////////////////////////////////////////////////////////
//private functions



}


?>
