<?php

class CatalogueController extends BaseController {

	protected $layout = 'layouts.main';
	protected $isAdmin;
	
	public function __construct() {
		
		$this->isAdmin = (Auth::check() && Auth::account()->rank > 1) ? TRUE : FALSE;
	}

	public function getIndex($catlang='') {
		
		if (Session::has('catlang') && strlen($catlang) < 1) $catlang = Session::get('catlang');
		
		if($catlang == 'dice') {
			
			if($this->isAdmin)
			{
				$manufacturers = DB::table('manufacturers')
					->join('products', 'products.man_id', '=', 'manufacturers.man_id')
					->where('products.cat_id', '=', '6')
					->select('manufacturers.man_id', 'manufacturers.name', 'manufacturers.logo')
					->orderBy('manufacturers.name', 'ASC')
					->distinct()
					->get();

			}
			else
			{

				$manufacturers = DB::table('manufacturers')
					->join('products', 'products.man_id', '=', 'manufacturers.man_id')
					->where('products.display', '=', 'true')
					->where('products.cat_id', '=', '6')
					->select('manufacturers.man_id', 'manufacturers.name', 'manufacturers.logo')
					->orderBy('manufacturers.name', 'ASC')
					->distinct()
					->get();
				
			}
			
			/*$queries = DB::getQueryLog();
			$last_query = end($queries);*/
			
			$x = 0;
			
			foreach($manufacturers as $m)
			{
				
				$data['manufacturers'][$x]['id'] = $m->man_id;
				$data['manufacturers'][$x]['name'] = $m->name;
				$data['manufacturers'][$x]['logo'] = $m->logo;
				
				$x++;
			}
			
			$bc = new Breadcrumbs();
			$data['breadcrumbs'] = $bc->getBreadcrumbs();
			
			$this->layout->content = View::make('catalogue.dice', $data);
			
		} else if ($catlang == 'b') {
			
			Session::put('catlang', $catlang);
			return Redirect::action('CatalogueController@getProductlines', array('cat_id' => '4'));
			
		} else {
		
			//$catIds = DB::select('select distinct "catId" from productlines pl join products p using ("plId") where p."prodLang" = ? or p."prodLang" = \'m\' order by "catId"', array($catlang));
			
			$catIds = DB::select('select distinct cat_id from products p where p.prod_lang = ? or p.prod_lang = \'m\' order by cat_id', array($catlang));
			
			$x=0;
			
			foreach($catIds as $catId) {
				
				$category = Category::find($catId->cat_id);
				
				if($category->menu_order)
				{
					$cat[$category->menu_order]['id'] = $category->cat_id;
					$cat[$category->menu_order]['name'] = $category->f_name;
					$cat[$category->menu_order]['logo'] = $category->logo;
				}
				
			}
			
			ksort($cat);
			
			$data['categories'] = array_values($cat);
			
			Session::put('catlang', $catlang);
			
			// Holy fuck it works!!!
			$bc = new Breadcrumbs();
			$data['breadcrumbs'] = $bc->getBreadcrumbs();		
			
			$this->layout->content = View::make('catalogue.categories', $data);

			
		}
		

	}

	public function getManufacturers($catid=6)
	{
			if($this->isAdmin)
			{
				$manufacturers = DB::table('manufacturers')
					->join('productlines', 'productlines.man_id', '=', 'manufacturers.man_id')
					->join('products', 'productlines.pl_id', '=', 'products.pl_id')
					->where('productlines.cat_id', '=', $catid)
					->select('manufacturers.man_id', 'manufacturers.name', 'manufacturers.logo')
					->orderBy('manufacturers.name', 'ASC')
					->get();
				
				
			}
			else
			{

				$manufacturers = DB::table('manufacturers')
					->join('productlines', 'productlines.man_id', '=', 'manufacturers.man_id')
					->join('products', 'productlines.pl_id', '=', 'products.pl_id')
					->where('products.display', '=', 'true')
					->where('productlines.cat_id', '=', $catid)
					->select('manufacturers.man_id', 'manufacturers.name', 'manufacturers.logo')
					->orderBy('manufacturers.name', 'ASC')
					->get();
				
			}
			
			$x = 0;
			
			foreach($manufacturers as $m)
			{
				
				$data['m'][$x]['id'] = $m->id;
				$data['m'][$x]['name'] = $m->name;
				$data['m'][$x]['name'] = $m->logo;
			}
			
			$this->layout->content = View::make('catalogue.manufacturers', $data);
		
	}

/*-----------*/

	/*private function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}

		array_multisort($sort_col, $dir, $arr);
		
		//USE:
		//array_sort_by_column($array, 'order');
	}*/


}
