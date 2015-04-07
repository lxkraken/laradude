<?php
 
class SubproductlinePresenter  {
 
	protected $subproductline;

	
	public function __construct(Subproductline $subproductline)
	{
		$this->subproductline = $subproductline;

		$locale = App::getLocale();
		
		$eBits = explode('~', $subproductline->e_name);
		$fBits = explode('~', $subproductline->f_name);
		
		$subplName['e'] = $eBits[0];
		$subplName['f'] = $fBits[0];

		$this->subproductline->name = (strlen($subproductline->f_name) < 1 && $locale{0} == 'f')  ? $subplName['e'] : $subplName['f'];
		$this->subproductline->logo = $subproductline->logo_url;
		
	}
	
	public function getSubproductline()
	{
		return $this->subproductline->toArray();
	}
	
}
