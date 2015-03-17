<?php

class CategoryController extends BaseController {

	protected $layout = 'layouts.main';
	protected $isAdmin;
	protected $data;
	
	public function __construct() {
		
		$this->isAdmin = (Auth::check() && Auth::user()->rank > 1) ? TRUE : FALSE;
	}

	public function index() {
		return Redirect::action('CatalogueController@getIndex');
		/*$this->layout->content = View::make('catalogue.product');*/
	}
	
	public function show($id) {
		
		
		$catlang = Session::get('catlang');
		

		$qNumProd = ($this->isAdmin) ? 'num_prod_admin' : 'num_prod';

		
		if($catlang == 'e' || $catlang == 'f')
		{
		
			if($this->isAdmin)
			{

				$productlines = DB::table('productlines')
					->join('products', 'productlines.pl_id', '=', 'products.pl_id')
					->where('products.cat_id', '=', $id)
					->where(function($query) use ($catlang)
					  {
						  $query->where('products.prod_lang', '=', $catlang)
							    ->orWhere('products.prod_lang', '=', 'm');
					  })
					->select('productlines.pl_id', 'productlines.e_name', 'productlines.f_name', 'productlines.f_logo_url', 'productlines.e_logo_url', 'productlines.f_caption', 'productlines.'.$qNumProd)
					->orderBy('productlines.'.$catlang.'_name')
					->distinct()
					->get();
				
				
			}
			else
			{

				$productlines = DB::table('productlines')
					->join('products', 'productlines.pl_id', '=', 'products.pl_id')
					->where('products.display', '=', 'true')
					->where('products.cat_id', '=', $id)
					->where(function($query) use ($catlang)
					  {
						  $query->where('products.prod_lang', '=', $catlang)
							    ->orWhere('products.prod_lang', '=', 'm');
					  })
					->select('productlines.pl_id', 'productlines.e_name', 'productlines.f_name', 'productlines.f_logo_url', 'productlines.e_logo_url', 'productlines.f_caption', 'productlines.'.$qNumProd)
					->orderBy('productlines.'.$catlang.'_name')
					->distinct()
					->get();
				
			}

			
		}
		else
		{
			if($this->isAdmin)
			{
				$productlines = DB::table('productlines')
					->join('products', 'productlines.pl_id', '=', 'products.pl_id')
					->where('products.cat_id', '=', $id)
					->select('productlines.pl_id', 'productlines.e_name', 'productlines.f_name', 'productlines.f_logo_url', 'productlines.e_logo_url', 'productlines.f_caption', 'productlines.'.$qNumProd)
					->orderBy('productlines.'.$catlang.'_name')
					->distinct()
					->get();
				
				
			}
			else
			{
			
				$productlines = DB::table('productlines')
					->join('products', 'productlines.pl_id', '=', 'products.pl_id')
					->where('products.display', '=', 'true')
					->where('products.cat_id', '=', $id)
					->select('productlines.pl_id', 'productlines.e_name', 'productlines.f_name', 'productlines.f_logo_url', 'productlines.e_logo_url', 'productlines.f_caption', 'productlines.'.$qNumProd)
					->orderBy('productlines.'.$catlang.'_name')
					->distinct()
					->get();
				
			}
			
		}
		
		// Show last query
		/*$queries = DB::getQueryLog();
		$data['last_query'] = end($queries);*/
		
		$category = Category::findOrFail($id);
		
		$this->data['catName'] = $category->f_name;
		
		$x = 0;
		
		foreach($productlines as $p)
		{

			
			$this->data['pl'][$x]['id'] = $p->pl_id;
			
			$n = (strlen($p->f_name) > 0) ? $p->f_name : $p->e_name;
			$name = explode('~', $n);
			$this->data['pl'][$x]['name'] = rtrim($name[0]);
			
			$this->data['pl'][$x]['caption'] = $p->f_caption;
			$this->data['pl'][$x]['logo'] = (strlen($p->f_logo_url) > 2) ? $p->f_logo_url : $p->e_logo_url;
			
			if($p->$qNumProd > 1)
			{
				$this->data['pl'][$x]['link'] = '/productline/'.$p->pl_id;
			}
			else
			{
				$prod = ($this->isAdmin) ? DB::table('products')->where('pl_id', '=', $p->pl_id)->select('code')->get() : DB::table('products')->where('pl_id', '=', $p->pl_id)->where('display', '=', 'true')->select('code')->get();
				$this->data['pl'][$x]['link'] = '/product/'.$prod[0]->code;
			}
			
			$x++;
		}
		
		$this->array_sort_by_column($this->data['pl'], 'name');
		
		// Holy fuck it works!!!
		$bc = new Breadcrumbs();
		$this->data['breadcrumbs'] = $bc->getBreadcrumbs();

		
		$this->layout->content = View::make('catalogue.productlines', $this->data);
	}



//------------------------------------------
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
