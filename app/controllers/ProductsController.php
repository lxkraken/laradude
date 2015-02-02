<?php

class ProductsController extends BaseController {

	protected $layout = 'layouts.main';

	public function getIndex() {
		$this->layout->content = View::make('catalogue.product');
	}
	
}
