<?php

class SearchController extends BaseController {

	protected $layout = 'layouts.main';
	protected $data;
	protected $isAdmin;
	
	public function __construct() {
		
		$this->isAdmin = (Auth::check() && Auth::user()->rank > 1) ? TRUE : FALSE;
	}

	public function getIndex()
	{
		
		if(Input::has('q'))
		{
			$s = new Search(Input::get('q'), $this->isAdmin);
			
			$codes = $s->getSearchResults();
			
			if(count($codes) > 0)
			{
				
				foreach($codes as $code => $score)
				{
					$product = Product::findOrFail($code);
					$product->score = $score;
					
					$this->data['products'][] = $product;

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
