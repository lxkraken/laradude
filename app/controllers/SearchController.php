<?php

class SearchController extends BaseController {

	protected $layout = 'layouts.main';
	protected $data;
	protected $rank;
	protected $account = null;
	
	public function __construct() {
		
		if(Auth::check())
		{
			$this->account = Auth::user();
			$this->rank = $this->account->rank;
		}
		else
		{
			$this->account = null;
			$this->rank = 0;
		}
	}

	public function getIndex()
	{
		
		if(Input::has('q'))
		{
			$s = new Search(Input::get('q'), $this->rank);
			
			$codes = $s->getSearchResults();
			
			if(count($codes) > 0)
			{
				
				foreach($codes as $code => $score)
				{
					
					$product = Product::findOrFail($code);
					$pp = new ProductPresenter($product, $this->account);
					
					$pArray = $pp->getProduct();
					
					$pArray['score'] = $score;
					
					$this->data['products'][] = $pArray;

				}
			}
			else
			{
				$this->data['products'] = null;
			}
			
		}
		else
		{
			$this->data['products'] = null;
		}

		$this->layout->content = View::make('search', $this->data);
	}



}
