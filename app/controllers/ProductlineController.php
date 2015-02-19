<?php

class ProductlineController extends BaseController {

	protected $layout = 'layouts.main';
	protected $isAdmin;

	
	public function __construct()
	{
		$this->isAdmin = (Auth::check() && Auth::account()->rank > 1) ? TRUE : FALSE;

	}

	public function index() {
		$this->layout->content = View::make('catalogue.productline');
	}
	
	public function show($id)
	{

		/* Check to see if catlang is set, otherwise pick the prodLang of one item in the productline. */

		if($this->isAdmin)
		{
			$p = DB::table('products')
							->where('pl_id', '=', $id)
							->take(1)
							->select('prod_lang')
							->get();
		}
		else
		{
			$p = DB::table('products')
							->where('pl_id', '=', $id)
							->where('display', '=', 'true')
							->take(1)
							->select('prod_lang')
							->get();
		}
		
		$catlang = rtrim($p[0]->prod_lang);
		
		Session::put('catlang', rtrim($p[0]->prod_lang));
		
		/**********************************
		 * Retrieve Productline information
		 */
		
		$pl = Productline::findOrFail($id);
		 
		$data['productline'] = $pl->toArray();
		
		
		/**************************
		 * Retrieve products that do not belong to a subproductline.
		 */

		$baseProducts = ($this->isAdmin) ? 
			    Product::productline($id)->subproductline(0)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->get() :
				Product::productline($id)->subproductline(0)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->display()->get();
				
		$baseProductsArray = $baseProducts->toArray();
		
		if(strlen($data['productline']['header_product']) > 1)
		{
			$codes = explode('~', $data['productline']['header_product']);
			
			foreach($baseProductsArray as $bpa)
			{
				if(in_array($bpa['code'], $codes))
				{
					$data['header_product'][] = $bpa;
				}
				else
				{
					$data['products'][] = $bpa;
				}
				
			}
			
		}
		elseif($data['productline']['header_product'] == 1)
		{
			$data['header_product'] = array_shift($baseProductsArray);
			$data['products'] = $baseProductsArray;

		}
		else
		{
			$data['products'] = $baseProductsArray;
			$data['header_product'] = 'none';
		}
		
		
						
		/************************
		 * Are there any products in a subproductline?
		 * 
		 * If so, scoop them up and classify them properly.
		 */
		 
		 $hasSubpl = ($this->isAdmin) ?
					 Product::productline($id)->prodlang($catlang)->where('subpl_id', '>', '0')->count() :
					 Product::productline($id)->prodlang($catlang)->where('subpl_id', '>', '0')->display()->count();
						
		if($hasSubpl > 0)
		{
			$subpls = ($this->isAdmin) ?
						DB::table('products')
						->join('subproductlines', 'products.subpl_id', '=', 'subproductlines.subpl_id')
						->where('products.pl_id', '=', $id)
						->where('products.subpl_id', '>', '0')
						->distinct()
						->select('products.subpl_id', 'subproductlines.f_name', 'subproductlines.e_name', 'subproductlines.logo_url')
						->get() :
						DB::table('products')
						->join('subproductlines', 'products.subpl_id', '=', 'subproductlines.subpl_id')
						->where('products.pl_id', '=', $id)
						->where('products.subpl_id', '>', '0')
						->where('display', '=', 'true')
						->distinct()
						->select('products.subpl_id', 'subproductlines.f_name', 'subproductlines.e_name', 'subproductlines.logo_url')
						->get();
			
			$x = 0;
			
			foreach($subpls as $s)
			{
				$data['subproductlines'][$x]['subpl_id'] = $s->subpl_id;
				$data['subproductlines'][$x]['f_name'] = $s->f_name;
				$data['subproductlines'][$x]['e_name'] = $s->e_name;
				$data['subproductlines'][$x]['logo'] = $s->logo_url;
				
				$products = ($this->isAdmin) ?
							 Product::subproductline($s->subpl_id)->productline($id)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->get() :
							 Product::subproductline($s->subpl_id)->productline($id)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->display()->get();
				
				$productsArray = $products->toArray();
				
				$data['subproductlines'][$x]['products'] = $productsArray;
				
				$x++;
							 
			}
			
			
		}
		
		// Holy fuck it works!!!
		$bc = new Breadcrumbs();
		$data['breadcrumbs'] = $bc->getBreadcrumbs();
		
		$this->layout->content = View::make('catalogue.productline', $data);
		
	}
	
}
