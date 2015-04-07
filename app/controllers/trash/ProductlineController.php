<?php

class ProductlineController extends BaseController {

	protected $layout = 'layouts.main';
	protected $rank;
	protected $data;
	protected $locale;
	protected $basket;
	protected $preorder;
	
	public function __construct() {
		
		if(Auth::check())
		{
			$this->rank = Auth::user()->rank;
			$account = Account::findOrFail(Auth::id());
			$this->basket = new Basket($account);
			$this->preorder = new Preorder($account);
		}
		else
		{
			$this->rank = 0;
		}
		
		$this->locale = App::getLocale();
	}

	public function index() {
		$this->layout->content = View::make('catalogue.productline');
	}
	
	public function show($id)
	{

		/* Check to see if catlang is set, otherwise pick the prodLang of one item in the productline. */

		if($this->rank > 1)
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
		 
		$this->data['productline'] = $pl->toArray();
		
		$this->data['productline']['name'] = (strlen($this->data['productline']['f_name']) < 1)  ? $this->data['productline']['e_name'] : $this->data['productline']['f_name'];
		
		
		/**************************
		 * Retrieve products that do not belong to a subproductline.
		 */

		$baseProducts = ($this->rank > 1) ? 
			    Product::productline($id)->subproductline(0)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->get() :
				Product::productline($id)->subproductline(0)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->display()->get();
				
		$baseProductsArray = $baseProducts->toArray();
		
		for($x = 0 ; $x < count($baseProductsArray); $x++)
		{
			$baseProductsArray[$x]['name'] = (strlen($baseProductsArray[$x]['f_name']) < 1)  ? stripslashes($baseProductsArray[$x]['e_name']) : stripslashes($baseProductsArray[$x]['f_name']);
			$baseProductsArray[$x]['description'] = (strlen($baseProductsArray[$x]['f_desc1']) < 1)  ? stripslashes($baseProductsArray[$x]['e_desc1']).stripslashes($baseProductsArray[$x]['e_desc2']) : stripslashes($baseProductsArray[$x]['f_desc1']).stripslashes($baseProductsArray[$x]['f_desc2']);
		}
		
		if(strlen($this->data['productline']['header_product']) > 1)
		{
			$codes = explode('~', $this->data['productline']['header_product']);
			
			foreach($baseProductsArray as $bpa)
			{
				if(in_array($bpa['code'], $codes))
				{
					$this->data['header_product'][] = $bpa;
				}
				else
				{
					$this->data['products'][] = $bpa;
				}
				
			}
			
		}
		elseif($this->data['productline']['header_product'] == 1)
		{
			$this->data['header_product'] = array_shift($baseProductsArray);
			$this->data['products'] = $baseProductsArray;

		}
		else
		{
			$this->data['products'] = $baseProductsArray;
			$this->data['header_product'] = 'none';
		}
		
		
						
		/************************
		 * Are there any products in a subproductline?
		 * 
		 * If so, scoop them up and classify them properly.
		 */
		 
		 $hasSubpl = ($this->rank > 1) ?
					 Product::productline($id)->prodlang($catlang)->where('subpl_id', '>', '0')->count() :
					 Product::productline($id)->prodlang($catlang)->where('subpl_id', '>', '0')->display()->count();
						
		if($hasSubpl > 0)
		{
			$subpls = ($this->rank > 1) ?
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
				$this->data['subproductlines'][$x]['subpl_id'] = $s->subpl_id;
				
				$n = (strlen($s->f_name) < 1)  ? stripslashes($s->e_name) : stripslashes($s->f_name);
				$nArr = explode('~', $n);
				
				$this->data['subproductlines'][$x]['name'] = $nArr[0];
				
				/*$data['subproductlines'][$x]['f_name'] = $s->f_name;
				$data['subproductlines'][$x]['e_name'] = $s->e_name;*/
				$this->data['subproductlines'][$x]['logo'] = $s->logo_url;
				
				$products = ($this->rank > 1) ?
							 Product::subproductline($s->subpl_id)->productline($id)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->get() :
							 Product::subproductline($s->subpl_id)->productline($id)->prodlang($catlang)->orderBy('prod_type')->orderBy('code')->display()->get();
				
				$productsArray = $products->toArray();
				
				for($z = 0 ; $z < count($productsArray); $z++)
				{
					$productsArray[$z]['subtitle'] = (strlen($productsArray[$z]['f_subtitle']) < 1)  ? stripslashes($productsArray[$z]['e_subtitle']) : stripslashes($productsArray[$z]['f_subtitle']);
					$productsArray[$z]['name'] = (strlen($productsArray[$z]['f_name']) < 1)  ? stripslashes($productsArray[$z]['e_name']) : stripslashes($productsArray[$z]['f_name']);

				}
				
				$this->data['subproductlines'][$x]['products'] = $productsArray;
				
				$x++;
							 
			}
			
			$this->array_sort_by_column($this->data['subproductlines'], 'name');
			
			
		}
		
		// Holy fuck it works!!!
		$bc = new Breadcrumbs();
		$this->data['breadcrumbs'] = $bc->getBreadcrumbs();
		
		$this->layout->content = ($catlang == 'dice') ? View::make('catalogue.diceproductline', $this->data) : View::make('catalogue.productline', $this->data);
		
	}
	
//-------------------------------

	private function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}

		array_multisort($sort_col, $dir, $arr);
		
		//USE:
		//array_sort_by_column($array, 'order');
	}
	
}
