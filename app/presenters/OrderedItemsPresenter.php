<?php
 
class OrderedItemsPresenter  {
 
	protected $oItems;
	
	public function __construct($items = null)
	{
		if($items)
		{
			$x = 0;
			
			$locale = App::getLocale();
			
			foreach($items as $i)
			{
				$this->oItems[$x]['code'] = $i->code;
				
				$product = Product::findOrFail($i->code);
				
				$pp = new ProductPresenter($product);
				
				$oItem = $pp->getProduct();
				
				$this->oItems[$x]['name'] = $oItem['name'];
				$this->oItems[$x]['qty'] = $i->qty;
				$this->oItems[$x]['link'] = (strlen($oItem['description']) > 1) ? '/product/'.$oItem['code'] : '';
				
				$this->oItems[$x]['msrp'] = $i->msrp;
				$this->oItems[$x]['retailer_discount'] = round($i->retailer_discount, 3);
				$this->oItems[$x]['extra_discount'] = round($i->extra_discount, 3);
				$this->oItems[$x]['retailer_price'] = sprintf("%01.2f", $i->msrp * (1 - ($i->retailer_discount * 0.01)) * (1 - ($i->extra_discount * 0.01)));
				$this->oItems[$x]['total_discount'] = round(1 - ($this->oItems[$x]['retailer_price'] / $i->msrp), 3);
				$this->oItems[$x]['total'] = sprintf("%01.2f", $i->qty * $this->oItems[$x]['retailer_price']);

				$x++;
			}
			

		}

		
	}
	
	public function getOrderedItems()
	{
		return $this->oItems;
	}
	
}
