<?php

class ProductController extends BaseController {

	protected $layout = 'layouts.main';

	public function index() {
		return Redirect::to('/productlines');
		/*$this->layout->content = View::make('catalogue.product');*/
	}
	
	public function show($id) {
		
		$product = Product::findOrFail(strtoupper($id));
		
		$data = $product->toArray();
		
		$this->layout->content = View::make('catalogue.product', $data);
	}
	
}
