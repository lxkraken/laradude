<?php

class ProductlineController extends BaseController {

	protected $layout = 'layouts.main';
	protected $data;
	protected $account;

	
	public function __construct() {
		
		if(Auth::check())
		{
			$this->account = Auth::user();
		}
		else
		{
			$this->account = null;
		}

	}

	public function index() {
		$this->layout->content = View::make('catalogue.productline');
	}
	
	public function show($id)
	{

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
	

	
}
