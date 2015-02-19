<?php

class ProductController extends BaseController {

	protected $layout = 'layouts.main';

	public function index() {
		return Redirect::to('/productlines');
		/*$this->layout->content = View::make('catalogue.product');*/
	}
	
	public function show($id) {
		
		$product = Product::findOrFail(strtoupper($id));
		
		$data['product'] = $product->toArray();
		
		$productline = Productline::findOrFail($product->pl_id);
		
		$data['productline'] = $productline->toArray();
		
		// Holy fuck it works!!!
		$bc = new Breadcrumbs();
		$data['breadcrumbs'] = $bc->getBreadcrumbs();
		
		$this->layout->content = View::make('catalogue.product', $data);
	}
	
}
