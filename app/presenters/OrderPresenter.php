<?php
 
class OrderPresenter  {
 
	protected $order;
	
	public function __construct(Order $order)
	{
		$this->order = $order;
		
		

		if($account)
		{
			$basket = new Basket($account);
			$preorder = new Preorder($account);
			
			$this->product->inBasket = $basket->inBasket($this->product);
			$this->product->inPreorder = $preorder->inPreorder($this->product);
		}
		
		$locale = App::getLocale();
		
		$name['e'] = $product->e_name;
		$name['f'] = $product->f_name;
		$subtitle['e'] = $product->e_subtitle;
		$subtitle['f'] = $product->f_subtitle;
		
		$this->product->name = stripslashes($name[$locale{0}]);
		
		$this->product->description = (strlen($product->f_desc1) < 1)  ? stripslashes($product->e_desc1).stripslashes($product->e_desc2) : stripslashes($product->f_desc1).stripslashes($product->f_desc2);
		$this->product->subtitle = (strlen($product->f_subtitle) < 1)  ? stripslashes($product->e_subtitle) : stripslashes($product->f_subtitle);
		
	}
	
	public function getProduct()
	{
		return $this->product->toArray();
	}
	
}
