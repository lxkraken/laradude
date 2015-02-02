<?php

class CatalogueController extends BaseController {

	protected $layout = 'layouts.main';

	public function getIndex($lang='f') {
		
		$data = DB::select('select distinct cat_id from product_lines pl join products p using (pl_id) where p.prod_lang = ? or p.prod_lang = \'m\'', array($lang));
		
		$x=0;
		
		foreach($data as $d) {
			
			$c = Category::find($d->cat_id);
			
			$cat['categories'][$x]['id'] = $c->cat_id;
			$cat['categories'][$x]['name'] = $c->f_name;
			
			$x++;
			
		}
		
		$this->layout->content = View::make('catalogue.categories', $cat);
		
		//$categories = DB::select('select distinct cat_id from product_lines pl join products p using (pl_id) where p.prod_lang = \''.$lang.'\' or p.prod_lang = \'m\'');
		
		//$data[] = $categories[0];
		
		/*return Redirect::to('/productlines');*/
		/*$this->layout->content = View::make('catalogue.product');*/
		
		//return View::make('layouts.main')->nest('content', 'catalogue.fcat')->with('categories', $categories);
		//$this->layout->content = View::make('catalogue.fcat', $data);
		
		//return Redirect::action('CatalogueController@getCategories');
		
		//return 'ass';
	}
	
	public function show($id) {
		
		$product = Product::findOrFail(strtoupper($id));
		
		$data = $product->toArray();
		
		$this->layout->content = View::make('catalogue.product', $data);
	}
	
	public function getCategories($lang='f') {
	
	
		$data = DB::table('product_lines')
					->join('products', function($join)
					{
						$join->on('product_lines.pl_id', '=', 'products.pl_id')
							  ->where('products.prod_lang', '=', 'f')
							  ->orWhere('products.prod_lang', '=', 'm');
					})
					->select('product_lines.cat_id')
					->distinct()
					->get();
					
		
		
		foreach($data as $d) $catIds[] = $d->cat_id;
		
		$this->layout->content = View::make('catalogue.categories', $catIds);
		
	}
	
}
