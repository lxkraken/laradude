<?php

class ManufacturerController extends BaseController {

	protected $layout = 'layouts.main';
	protected $isAdmin;
	protected $data;
	
	public function __construct() {
		
		$this->isAdmin = (Auth::check() && Auth::user()->rank > 1) ? TRUE : FALSE;
	}

	public function index()
	{
		return 'A list of all Manufacturers';
	}
	
	public function show($id)
	{
		
		
		
	}
	
	public function dice($id)
	{
		if($this->isAdmin)
		{
			$pldIds = DB::table('products')
							->where('products.man_id', '=', $id)
							->select('products.pl_id')
							->distinct()
							->get();
		}
		else
		{
			$plIds = DB::table('products')
							->where('products.man_id', '=', $id)
							->where('products.display', '=', 'true')
							->select('products.pl_id')
							->distinct()
							->get();
		}
		
		$manufacturer = Manufacturer::findOrFail($id);
		
		$this->data['catName'] = $manufacturer->name;
		
		$x = 0;
		
		foreach($plIds as $plId)
		{
			$pl = Productline::findOrFail($plId->pl_id);
			
			$this->data['pl'][$x]['id'] = $plId->pl_id;
			$this->data['pl'][$x]['name'] = $pl->f_name;
			$this->data['pl'][$x]['logo'] = $pl->f_logo_url;
			$this->data['pl'][$x]['caption'] = $pl->f_caption;
			$this->data['pl'][$x]['link'] = '/productline/'.$plId->pl_id;
			
			$x++;

		}
		
		Session::put('catlang', 'dice');
		
		// Holy fuck it works!!!
		$bc = new Breadcrumbs();
		$this->data['breadcrumbs'] = $bc->getBreadcrumbs();
		
		$this->layout->content = View::make('catalogue.productlines', $this->data);
	}

}
