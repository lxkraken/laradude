<?php

class Breadcrumbs {
	
	protected $section;
	protected $pathElements;
	protected $catlang;
	protected $breadcrumbs;
	protected $account;
	protected $rank;
	//protected $isAdmin;
	
	public function __construct()
	{
		
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
	
		$this->pathElements = explode('/', Request::path());
		$this->catlang = Session::get('section', 'f');
		$this->isAdmin = (Auth::check() && Auth::user()->rank > 1) ? TRUE : FALSE;
		
		$this->section = array(
						'f' => Lang::get('navigation.gamesinfrench'),
						'e' => Lang::get('navigation.gamesinenglish'),
						'dice' => Lang::get('navigation.diceandacc'),
						'b' => Lang::get('navigation.dustmagnets')
						);
		$this->breadcrumbs = array(array('link' => '/', 'text' => Lang::get('navigation.home')));

	}

	public function getBreadcrumbs()
	{
		
		switch($this->pathElements[0])
		{
			case 'catalogue':
				$this->generateCatalogueCrumb();
				break;
				
			case 'category':
				$this->generateCategoryCrumb($this->pathElements[1]);
				break;
				
			case 'manufacturer':
				$this->generateManufacturerCrumb($this->pathElements[2]);
				break;
				
			case 'productline':
				$this->generateProductlineCrumb($this->pathElements[1]);
				break;
				
			case 'product':
				$this->generateProductCrumb($this->pathElements[1]);
				break;
		}
		
		return $this->breadcrumbs;
	}


//--------------

	private function generateCatalogueCrumb()
	{
		if($this->pathElements[0] == 'catalogue')
		{
			$this->breadcrumbs[] = array('link' => 'active', 'text' => $this->section[$this->catlang]);
		}
		else
		{
			$this->breadcrumbs[] = array('link' => '/catalogue/'.$this->catlang, 'text' => $this->section[$this->catlang]);
		}
		
	}


	private function generateCategoryCrumb($id)
	{
		$c = Category::findOrFail($id);
		
		$cp = new CategoryPresenter($c);
		
		$cat = $cp->getCategory();
		
		if($this->pathElements[0] == 'category')
		{
			$this->generateCatalogueCrumb();
			$this->breadcrumbs[] = array('link' => 'active', 'text' => $cat['name']);
		}
		else
		{
			$this->breadcrumbs[] = array('link' => '/category/'.$id, 'text' => $cat['name']);
		}	

	}
	
	private function generateProductlineCrumb($id)
	{
		$pl = Productline::findOrFail($id);
		
		$pp = new ProductlinePresenter($pl, $this->account);
		
		$productline = $pp->getProductline();
		
		//$qNumProd = ($this->rank > 1) ? 'num_prod_admin' : 'num_prod';
		
		if($productline['numprod'] > 1)
		{
		
			if($this->rank > 1)
			{
				$p = DB::table('products')
								->where('pl_id', '=', $id)
								->select('cat_id', 'man_id')
								->first();
			}
			else
			{
				$p = DB::table('products')
								->where('pl_id', '=', $id)
								->where('display', '=', 'true')
								->select('cat_id', 'man_id')
								->first();
			}
			
			//$name = (strlen($pl->f_name) < 1)  ? stripslashes($pl->e_name) : stripslashes($pl->f_name);
			
			if($this->pathElements[0] == 'productline')
			{
				
				if($this->catlang == 'dice')
				{
				    $this->generateManufacturerCrumb($p->man_id);
				}
				else
				{
					$this->generateCatalogueCrumb();
					$this->generateCategoryCrumb($p->cat_id);
				}
				$this->breadcrumbs[] = array('link' => 'active', 'text' => $productline['name']);
			}
			else
			{
				$this->breadcrumbs[] = array('link' => '/productline/'.$id, 'text' => $productline['name']);
			}
		}	
		
		
	}
	
	private function generateProductCrumb($code)
	{
		$p = Product::findOrFail($code);
		
		$pp = new ProductPresenter($p, $this->account);
		
		$product = $pp->getProduct();
		
		$this->generateCatalogueCrumb();
		
		$this->generateCategoryCrumb($product['cat_id']);
		
		$this->generateProductlineCrumb($product['pl_id']);
		
		$this->breadcrumbs[] = array('link' => 'active', 'text' => $product['name']);
		
		
	}
	
	private function generateManufacturerCrumb($id)
	{
		$man = Manufacturer::findOrFail($id);
		
		$this->generateCatalogueCrumb();
		
		if($this->pathElements[0] == 'manufacturer')
		{
			$this->breadcrumbs[] = array('link' => 'active', 'text' => stripslashes($man->name));
		}
		else
		{
			$this->breadcrumbs[] = array('link' => '/manufacturer/dice/'.$id, 'text' => stripslashes($man->name));
		}		
		
		
	}


}
