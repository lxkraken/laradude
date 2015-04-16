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
		
		$subplCaption['e'] = $subproductline->e_caption;
		$subplCaption['f'] = $subproductline->f_caption;
		
		$this->subproductline->caption = $subplCaption[$locale{0}];

		if(strlen($subplName[$locale{0}]) < 1)
		{
			
			$this->subproductline->name = ($locale{0} == 'f')  ? stripslashes($subplName['e']) : stripslashes($subplName['f']);
			
		}
		else
		{
			
			$this->subproductline->name = $subplName[$locale{0}];
			
		}
		$this->subproductline->logo = $subproductline->logo_url;
		
	}
	
	public function getSubproductline()
	{
		return $this->subproductline->toArray();
	}
	
}
