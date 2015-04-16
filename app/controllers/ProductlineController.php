<?php

class ProductlineController extends BaseController {

	protected $layout = 'layouts.main';
	protected $data;
	protected $account;
	protected $rank;
	protected $status;

	
	public function __construct() {
		
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
		
	}

	public function index() {
		
		return Redirect::action('CatalogueController@getIndex');
		
	}
	
	public function show($id)
	{
		$cl = new ClickLogger($this->account);
		
		$cl->registerClick(Request::path());

		$ss = new CatalogueSectionSetter();

		$productline = Productline::findOrFail($id);
		
		$ss->setSectionByProductline($productline);
		
		$plp = new ProductlinePresenter($productline);
		
		$this->data['pl'] = $plp->getProductline();
		
		$pip = new ProductlineItemsPresenter($productline, Session::get('section'), $this->account);
		
		$plProducts = $pip->getProductlineItems();
		
		if(isset($plProducts['header_product'])) $this->data['header_product'] = $plProducts['header_product'];
		if(isset($plProducts['demo'])) $this->data['demo'] = $plProducts['demo'];
		if(isset($plProducts['subproductlines'])) $this->data['subproductlines'] = $plProducts['subproductlines'];
		if(isset($plProducts['base'])) $this->data['base'] = $plProducts['base'];

		$bc = new Breadcrumbs();
		
		$this->data['breadcrumbs'] = $bc->getBreadcrumbs();
		
		$this->layout->content = (Session::get('section') == 'dice') ? View::make('catalogue.diceproductline', $this->data) : View::make('catalogue.productline', $this->data);
		
	}
	
	public function edit($id)
	{
		if($this->rank > 1)
		{
			if(Session::has('status')) {
				
				$status = Session::pull('status');
				
				if(!$status['status'])
				{
					$this->data['errors'] = $status['failed'];
					$this->data['status'] = false;
				}
				else
				{
					if(isset($status['updated'])) $this->data['updated'] = 1;
					$this->data['status'] = true;
				}

			}
			
			$productline = Productline::findOrFail($id);
			
			$this->data['plObj'] = $productline;
			
			$plp = new ProductlinePresenter($productline, $this->account);
			
			$this->data['productline'] = $plp->getProductline();
			
			$section = Session::get('section');
			
			$plip = new ProductlineItemsPresenter($productline, $section, $this->account);
			
			$this->data['products'] = $plip->getProductlineItems();

			if(strlen($this->data['productline']['header_product']) > 2)
			{

				$this->data['currentHeaderProduct'] = explode('~', $this->data['productline']['header_product']);

			}
			
			$x=0;
			
			if(isset($this->data['products']['header_product']))
			{
				foreach($this->data['products']['header_product'] as $p)
				{
					$this->data['plist'][$x]['code'] = $p['code'];
					$this->data['plist'][$x]['name'] = $p['name'];
					$x++;
				}
			}
			
			if(isset($this->data['products']['base']))
			{
				foreach($this->data['products']['base'] as $p)
				{
					$this->data['plist'][$x]['code'] = $p['code'];
					$this->data['plist'][$x]['name'] = $p['name'];
					$x++;
				}
			}			
			
			$this->layout->content = View::make('admin.productline-edit', $this->data);
		}
		else
		{
			return Redirect::action('CatalogueController@getIndex');
		}
		
	}
	
	public function store()
	{
		$input = Input::all();
		
		$validator = new ValidationHelper;
		
		$status = $validator->productline($input);
		
		Session::put('status', $status);
		
		if($status['status'])
		{
			$plObj = new Productline;
			
			$pl = new ProductlineHelper;
			
			$pl->updateProductline($input, $plObj);
			
			return Redirect::route('productline.edit', array($plObj->pl_id));

		}
		else
		{
			return Redirect::route('productline.create');
			
		}
		
		
	}
	
	public function update()
	{

		$input = Input::all();
		
		$validator = new ValidationHelper;
		
		$status = $validator->productline($input);
		
		$status['updated'] = 1;
		
		if(isset($status['created'])) unset($status['created']);
		
		Session::put('status', $status);
		
		if($status['status'])
		{
			
			$pl = new ProductlineHelper;
			
			$plObj = Productline::findOrFail($input['pl_id']);
			
			$pl->updateProductline($input, $plObj);

		}
		
		return Redirect::route('productline.edit', array($input['pl_id']));

	}
	
	public function create()
	{
		
		if(Session::has('status')) {
				
			$status = Session::pull('status');
				
			if(!$status['status'])
			{
				$this->data['errors'] = $status['failed'];
				$this->data['status'] = false;
				}
			else
			{
				$this->data['status'] = true;
			}

		}
		else
		{
			$this->data = array();
		}
		
		$this->layout->content = View::make('admin.productline-create', $this->data);
		
	}
	
	
/**********************************************
 * Private Function
 **********************************************/


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
