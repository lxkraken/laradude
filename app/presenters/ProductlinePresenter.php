<?php
 
class ProductlinePresenter  {
 
	protected $productline;
	
	public function __construct(Productline $productline)
	{
		$this->productline = $productline;

		$locale = App::getLocale();
		
		$plName['e'] = $productline->e_name;
		$plName['f'] = $productline->f_name;
		$plLogo['e'] = $productline->e_logo_url;
		$plLogo['f'] = $productline->f_logo_url;
		$plCaption['e'] = $productline->e_caption;
		$plCaption['f'] = $productline->f_caption;
		
		$p = (strlen($plName[$locale{0}]) < 1 && $locale{0} == 'f')  ? stripslashes($plName['e']) : stripslashes($plName['f']);
		
		$pBits = explode('~', $p);
			
		$this->productline->name = trim($pBits[0]);
		$this->productline->logo = (strlen($plLogo[$locale{0}]) < 1 && $locale{0} == 'f')  ? $plLogo['e'] : $plLogo['f'];
		$this->productline->caption = $plCaption[$locale{0}];
		
	}
	
	public function getProductline()
	{
		return $this->productline->toArray();
	}
	
}
