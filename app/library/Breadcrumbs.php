<?php

class Breadcrumbs {
	
	protected $section = array('f' => 'Jeux en fran&ccedil;ais', 'e' => 'Jeux en anglais', 'dice' => 'D&eacute;s et Accessoires', 'b' => 'Les B&eacute;belles');
	protected $pathElements;
	protected $catlang;
	protected $breadcrumbs = array(array('link' => '/', 'text' => 'Accueil'));
	protected $isAdmin;
	
	public function __construct()
	{
	
		$this->pathElements = explode('/', Request::path());
		$this->catlang = Session::get('catlang', 'f');
		$this->isAdmin = (Auth::check() && Auth::account()->rank > 1) ? TRUE : FALSE;

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
		$cat = Category::findOrFail($id);
		
		if($this->pathElements[0] == 'category')
		{
			$this->generateCatalogueCrumb();
			$this->breadcrumbs[] = array('link' => 'active', 'text' => stripslashes($cat->f_name));
		}
		else
		{
			$this->breadcrumbs[] = array('link' => '/category/'.$id, 'text' => stripslashes($cat->f_name));
		}	

	}
	
	private function generateProductlineCrumb($id)
	{
		$pl = Productline::findOrFail($id);
		
		$qNumProd = ($this->isAdmin) ? 'num_prod_admin' : 'num_prod';
		
		if($pl[$qNumProd] > 1)
		{
		
			if($this->isAdmin)
			{
				$p = DB::table('products')
								->where('pl_id', '=', $id)
								->take(1)
								->select('cat_id')
								->get();
			}
			else
			{
				$p = DB::table('products')
								->where('pl_id', '=', $id)
								->where('display', '=', 'true')
								->take(1)
								->select('cat_id')
								->get();
			}
			
			
			
			if($this->pathElements[0] == 'productline')
			{
				$this->generateCatalogueCrumb();
				$this->generateCategoryCrumb($p[0]->cat_id);
				$this->breadcrumbs[] = array('link' => 'active', 'text' => stripslashes($pl->f_name));
			}
			else
			{
				$this->breadcrumbs[] = array('link' => '/productline/'.$id, 'text' => stripslashes($pl->f_name));
			}
		}	
		
		
	}
	
	private function generateProductCrumb($code)
	{
		$p = Product::findOrFail($code);
		
		$this->generateCatalogueCrumb();
		
		$this->generateCategoryCrumb($p->cat_id);
		
		$this->generateProductlineCrumb($p->pl_id);
		
		$this->breadcrumbs[] = array('link' => 'active', 'text' => stripslashes($p->f_name));
		
		
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
