<?php

class ProductController extends BaseController {

	protected $layout = 'layouts.main';
	protected $isAdmin;
	protected $data;
	
	public function __construct() {
		
		$this->isAdmin = (Auth::check() && Auth::user()->rank > 1) ? TRUE : FALSE;
	}

	public function index() {
		return Redirect::to('/productlines');
		/*$this->layout->content = View::make('catalogue.product');*/
	}
	
	public function show($id) {
		
		$product = Product::findOrFail(strtoupper($id));
		
		$this->data['product'] = $product->toArray();
		
		switch($this->data['product']['prod_lang'])
		{
			case 'dice':
			case 'e':
			case 'f':
				Session::put('catlang', $this->data['product']['prod_lang']);
				break;
			
			case 'b':
			case 'm':
				Session::put('catlang', 'f');
				break;
		}
		
		$this->data['product']['description'] = (strlen($product['f_desc1']) < 1)  ? stripslashes($product['e_desc1']).stripslashes($product['e_desc2']) : stripslashes($product['f_desc1']).stripslashes($product['f_desc2']);
		
		$this->data['product']['name'] = (strlen($product['f_name']) < 1)  ? stripslashes($product['e_name']) : stripslashes($product['f_name']);

		$productline = Productline::findOrFail($product->pl_id);
		
		$this->data['productline'] = $productline->toArray();
		
		$p = (strlen($this->data['productline']['f_name']) < 1)  ? stripslashes($this->data['productline']['e_name']) : stripslashes($this->data['productline']['f_name']);
		
		$pBits = explode('~', $p);
		
		$this->data['productline']['name'] = trim($pBits[0]);
		
		// Holy fuck it works!!!
		$bc = new Breadcrumbs();
		$this->data['breadcrumbs'] = $bc->getBreadcrumbs();
		
		$this->layout->content = View::make('catalogue.product', $this->data);
	}
	
}
