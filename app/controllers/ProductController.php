<?php

class ProductController extends BaseController {

	protected $layout = 'layouts.main';
	protected $rank;
	protected $data;
	protected $account;

	
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
		return Redirect::to('/productlines');
		/*$this->layout->content = View::make('catalogue.product');*/
	}
	
	public function show($id) {
		
		//$pp = ($this->account) ? new ProductPresenter(Product::findOrFail(strtoupper($id)), $this->account) : new ProductPresenter(Product::findOrFail(strtoupper($id)));
		
		$pp = new ProductPresenter(Product::findOrFail(strtoupper($id)), $this->account);

		$product = $pp->getProduct();
		
		if($product['display'] == 'true' || $this->rank > 1)
		{
			$ss = new CatalogueSectionSetter;
			
			$ss->setSectionByProduct($product['prod_lang']);
			
			$plp = new ProductlinePresenter(Productline::findOrFail($product['pl_id']));
		
			$this->data['pl'] = $plp->getProductline();
			
			$this->data['p'] = $product;
			
			// Holy fuck it works!!!
			$bc = new Breadcrumbs();
			$this->data['breadcrumbs'] = $bc->getBreadcrumbs();
			
			$this->layout->content = View::make('catalogue.product', $this->data);
		}
		else
		{
			return Redirect::to('/');
		}
	}
	
}
