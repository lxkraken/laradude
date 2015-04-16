<?php
 
class ProductlinePresenter  {
 
	protected $productline;

	
	public function __construct(Productline $productline, Account $account = null)
	{
		$this->productline = $productline;

		$locale = App::getLocale();
		
		$numProd = ($account && $account->rank > 1)
					? 
					DB::table('products')
						->where('pl_id', $productline->pl_id)
						->count()
					:
					DB::table('products')
							->where('pl_id', $productline->pl_id)
							->where('display', 'true')
							->count();
							
		if($numProd > 1)
		{
			
			$this->productline['link'] = '/productline/'.$productline->pl_id;
			
		}
		else
		{
			
			$prod = ($account && $account->rank > 1) ? DB::table('products')->where('pl_id', '=', $productline->pl_id)->select('code')->first() : DB::table('products')->where('pl_id', '=', $productline->pl_id)->where('display', '=', 'true')->select('code')->first();
			
			if($prod) $this->productline['link'] = '/product/'.$prod->code;

		}

		
		$plName['e'] = $productline->e_name;
		$plName['f'] = $productline->f_name;
		$plLogo['e'] = $productline->e_logo_url;
		$plLogo['f'] = $productline->f_logo_url;
		$plCaption['e'] = $productline->e_caption;
		$plCaption['f'] = $productline->f_caption;
		
		if(strlen($plName[$locale{0}]) < 1)
		{
			
			$p = ($locale{0} == 'f')  ? stripslashes($plName['e']) : stripslashes($plName['f']);
			
		}
		else
		{
			
			$p = $plName[$locale{0}];
			
		}
		
		$pBits = explode('~', $p);
			
		$this->productline->name = trim($pBits[0]);

		if(strlen($plLogo[$locale{0}]) < 1)
		{
			
			$this->productline->logo = ($locale{0} == 'f')  ? stripslashes($plLogo['e']) : stripslashes($plLogo['f']);
			
		}
		else
		{
			
			$this->productline->logo = $plLogo[$locale{0}];
			
		}
		
		
		$this->productline->caption = $plCaption[$locale{0}];
		$this->productline->numprod = $numProd;
		
		
		
	}
	
	public function getProductline()
	{
		return $this->productline->toArray();
	}
	
}
