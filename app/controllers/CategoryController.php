<?php

class CategoryController extends BaseController {

	protected $layout = 'layouts.main';
	protected $account;
	protected $rank;
	protected $data;
	
	public function __construct() {
		
		if(Auth::check())
		{
			$this->account = Account::findOrFail(Auth::id());
			$this->rank = $this->account->rank;
		}
		else
		{
			$this->rank = 0;
			$this->account = null;
		}
	}

	public function index() {
		return Redirect::action('CatalogueController@getIndex');
	}
	
	public function show($id) {
		
		
		$section = Session::get('section');

		if($this->rank > 1)
		{

			$productlines = DB::table('productlines')
				->join('products', 'productlines.pl_id', '=', 'products.pl_id')
				->where('products.cat_id', '=', $id)
				->where(function($query) use ($section)
				  {
					  $query->where('products.prod_lang', '=', $section)
						    ->orWhere('products.prod_lang', '=', 'm');
				  })
				->select('productlines.pl_id')
				->distinct()
				->get();
				
				
		}
		else
		{

			$productlines = DB::table('productlines')
				->join('products', 'productlines.pl_id', '=', 'products.pl_id')
				->where('products.display', '=', 'true')
				->where('products.cat_id', '=', $id)
				->where(function($query) use ($section)
				  {
					  $query->where('products.prod_lang', '=', $section)
						    ->orWhere('products.prod_lang', '=', 'm');
				  })
				->select('productlines.pl_id')
				->distinct()
				->get();
				
			}

		// Show last query
		/*$queries = DB::getQueryLog();
		$data['last_query'] = end($queries);*/
		
		//$category = Category::findOrFail($id);
		
		$cp = new CategoryPresenter(Category::findOrFail($id));
		
		$category = $cp->getCategory();
		
		$this->data['catName'] = $category['name'];
		
		$x = 0;
		
		foreach($productlines as $p)
		{
			$productline = Productline::findOrFail($p->pl_id);
			
			$pp = new ProductlinePresenter($productline, $this->account);
			
			$this->data['pl'][] = $pp->getProductline();

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
