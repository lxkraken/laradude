<?php
 
class SubproductlineItemsPresenter  {
 
	protected $subproductline;
	protected $account;
	
	public function __construct(Subproductline $subproductline, Account $account = null)
	{
		$this->subproductline = $subproductline;
		$this->account = $account;

		$locale = App::getLocale();
		
		$subplName['e'] = $subproductline->e_name;
		$subplName['f'] = $subproductline->f_name;
		$subplLogo['e'] = $subproductline->e_logo_url;
		$subplLogo['f'] = $subproductline->f_logo_url;
		$subplCaption['e'] = $subproductline->e_caption;
		$subplCaption['f'] = $subproductline->f_caption;
		
		$p = (strlen($plName[$locale{0}]) < 1 && $locale{0} == 'f')  ? stripslashes($plName['e']) : stripslashes($plName['f']);
		
		$pBits = explode('~', $p);
			
		$this->productline->name = trim($pBits[0]);
		$this->productline->logo = (strlen($plLogo[$locale{0}]) < 1 && $locale{0} == 'f')  ? $plLogo['e'] : $plLogo['f'];
		$this->productline->caption = $plCaption[$locale{0}];
		
	}
	
	public function getProductline()
	{
		return $this->productline;
	}
	
}
