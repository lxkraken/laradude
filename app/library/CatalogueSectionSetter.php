<?php

class CatalogueSectionSetter {

	public function setSectionByProduct($prodlang)
	{
		switch($prodlang)
		{
			case 'dice':
			case 'e':
			case 'f':
			case 'b':
				Session::put('section', $prodlang);
				break;
			case 'm':
				$locale = App::getLocale();
				Session::put('section', $locale{0});
				break;
		}		
		
		
	}
	
	public function setSectionByProductline(Productline $productline)
	{
		
		$product = (Auth::check() && Auth::user()->rank > 1) ? Product::productline($productline->pl_id)->firstOrFail() : Product::productline($productline->pl_id)->display()->firstOrFail();
		
		$this->setSectionByProduct($product->prod_lang);		

	}

}
