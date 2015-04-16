<?php
 
class ProductPresenter  {
 
	protected $product;
	
	public function __construct(Product $product, Account $account = null)
	{
		$this->product = $product;
		
		

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
		
		if(strlen($name[$locale{0}]) < 1)
		{
			
			$this->product->name = ($locale{0} == 'f')  ? stripslashes($name['e']) : stripslashes($name['f']);
			
		}
		else
		{
			
			$this->product->name = $name[$locale{0}];
			
		}

		if(strlen($subtitle[$locale{0}]) < 1)
		{
			
			$this->product->subtitle = ($locale{0} == 'f')  ? stripslashes($subtitle['e']) : stripslashes($subtitle['f']);
			
		}
		else
		{
			
			$this->product->subtitle = $subtitle[$locale{0}];
			
		}		
		$this->product->description = (strlen($product->f_desc1) < 1)  ? stripslashes($product->e_desc1).stripslashes($product->e_desc2) : stripslashes($product->f_desc1).stripslashes($product->f_desc2);
		
		switch($product->available)
		{
			case 0;
				$this->product->button = Lang::get('catalogue.nomore');
				break;
				
			case 1:
				$this->product->button = Lang::get('catalogue.intransit');
				break;
				
			case 2:
				$this->product->button = Lang::get('catalogue.onorder');
				break;
				
			case 3:
				$this->product->button = Lang::get('catalogue.reprint');
				break;
				
			case 4:
				$dateBits = explode('-', $product->release_date);
				$this->product->button = $this->getSeason($dateBits[1]).', '.$dateBits[0];
				break;
				
			case 5:
				$this->product->button = Lang::get('catalogue.goneforever');
				break;
		}
		
	}
	
	public function getProduct()
	{
		return $this->product->toArray();
	}


//////////////////////////////////////////////////////////////////
//private fuctions
	
	private function getSeason($month) {
		
		switch($month) {
			
			case 12:
			case 1:
			case 2:
				$output = Lang::get('catalogue.winter');
				break;
			
			case 3:
			case 4:
			case 5:
				$output = Lang::get('catalogue.spring');
				break;
			
			case 6:
			case 7:
			case 8:
				$output = Lang::get('catalogue.summer');
				break;
				
			case 9:
			case 10:
			case 11:
				$output = Lang::get('catalogue.autumn');
				break;
				
		}
		
		return $output;
		
	}

	
}
