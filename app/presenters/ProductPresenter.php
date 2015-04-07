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
		
		$this->product->name = stripslashes($name[$locale{0}]);
		
		$this->product->description = (strlen($product->f_desc1) < 1)  ? stripslashes($product->e_desc1).stripslashes($product->e_desc2) : stripslashes($product->f_desc1).stripslashes($product->f_desc2);
		$this->product->subtitle = (strlen($product->f_subtitle) < 1)  ? stripslashes($product->e_subtitle) : stripslashes($product->f_subtitle);
		
		switch($product->available)
		{
			case 0;
				$this->product->button = 'Y\'a n\'a plus';
				break;
				
			case 1:
				$this->product->button = 'En Transit';
				break;
				
			case 2:
				$this->product->button = 'En Commande';
				break;
				
			case 3:
				$this->product->button = 'En R&eacute;impression';
				break;
				
			case 4:
				$dateBits = explode('-', $product->release_date);
				$this->product->button = $this->getFrenchSeason($dateBits[1]).', '.$dateBits[0];
				break;
				
			case 5:
				$this->product->button = 'Fini Pour Toute La Vie';
				break;
		}
		
	}
	
	public function getProduct()
	{
		return $this->product->toArray();
	}


//////////////////////////////////////////////////////////////////
//private fuctions
	
	private function getFrenchSeason($month) {
		
		switch($month) {
			
			case 12:
			case 1:
			case 2:
				$output = 'Hiver';
				break;
			
			case 3:
			case 4:
			case 5:
				$output = 'Printemps';
				break;
			
			case 6:
			case 7:
			case 8:
				$output = '&Eacute;t&eacute;';
				break;
				
			case 9:
			case 10:
			case 11:
				$output = 'Automne';
				break;
				
		}
		
		return $output;
		
	}
	
	private function getEnglishSeason($month) {
		
		switch($month) {
			
			case 12:
			case 1:
			case 2:
				$output = 'Winter';
				break;
			
			case 3:
			case 4:
			case 5:
				$output = 'Spring';
				break;
			
			case 6:
			case 7:
			case 8:
				$output = 'Summer';
				break;
				
			case 9:
			case 10:
			case 11:
				$output = 'Autumn';
				break;
				
		}
		
		return $output;
		
	}
	
}
