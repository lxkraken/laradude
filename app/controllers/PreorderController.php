<?php

class PreorderController extends BaseController {
 
	protected $layout = 'layouts.main';
	protected $data;
	protected $preorder;
	protected $account = null;
	
	public function __construct() {
		
		if(Auth::check())
		{
			$this->account = Auth::user();
			$this->preorder = new Preorder($this->account);
		}
		else
		{
			$this->account = null;
		}


	}
    public function getIndex() {

		$items = $this->preorder->getPreorder();

		if(count($items) > 0)
		{
			$oip = new PreorderedItemsPresenter($items);
			$this->data['items'] = $oip->getPreorderedItems();

		}
		
		$this->layout->content = View::make('orders.preorder', $this->data);
    }
    
	public function postIndex() {
		
		$input = Input::all();
		
		$poItems = $this->preorder->getPreorder();
		
		foreach($poItems as $pi) if($pi->qty != $input[$pi->code]) $this->preorder->updateItem(Product::findOrFail($pi->code), $input[$pi->code]);

		return Redirect::to('/preorder');

	}
	
	public function getRemove($code='')
	{
		if(strlen($code) > 1) 
		{
			$this->preorder->updateItem(Product::findOrFail($code), 0);
		}
		
		return Redirect::to('/preorder');
	}
	
	public function postQuicksearch() {
	
		if(Input::has('qs') && strlen(Input::get('qs')) > 0)
		{
			$this->data['qsQuery'] = Input::get('qs');
		
			$search = new Search($this->data['qsQuery'], $this->account->rank);
			
			$codes = array_slice($search->getSearchResults(), 0, 5);
			
			if(count($codes) > 0)
			{
				$this->data['qsMsg'] = 'Voici les r&eacute;sultats...';
				
				foreach($codes as $code => $score)
				{
					$pp = new ProductPresenter(Product::findOrFail($code), $this->account);
					$this->data['qsResults'][] = $pp->getProduct();
				}
				
			}
			else
			{
				$this->data['qsMsg'] = 'Aucun r&eacute;sultat!';
			}
			
		}

		
		$this->layout->content = View::make('orders.basket', $this->data);
		
	}
 
    /**
     * handle data posted by ajax request
     */
 /*   public function update() {
		
		if($this->account->rank > 0)
		{
		
			//check if its our form
			if ( Session::token() !== Input::get( '_token' ) ) {
				return Response::json( array(
					'msg' => 'Unauthorized attempt to create setting'
				) );
			}

			
			$verb = Input::get( 'verb' );
			$code = Input::get( 'code' );
			$product = Product::findOrFail( $code );
			$qty = Input::get( $verb.'-'.$code );

			switch($verb)
			{
				case 'tt':
					$color = '#EC9923';
					$this->basket->updateItem($product, $qty);
					$value = $this->basket->getNumberOfItems();
					break;
					
				case 'reserve':
					$color = '#D14642';
					$preorder = new Preorder($this->account);
					$preorder->updateItem($product, $qty);
					$value = $preorder->getNumberOfItems();
					break;
					
				case 'buy':
					$color = '#4EA64E';
					$this->basket->updateItem($product, $qty);
					$value = '$'.$this->basket->getSubtotal();
					break;
			}
			
			$inputbg = ($qty > 0) ? $color : '#ffffff';
			$inputfg = ($qty > 0) ? '#ffffff' : '#000000';

			
			$response = array(
				'status' => 'success',
				'verb' => $verb,
				'code' => $code,
				'anim' => 'anim'.$verb,
				'color' => $color,
				'value' => $value,
				'inputbg' => $inputbg,
				'inputfg' => $inputfg
			);
	 
			return Response::json( $response );
			
		}
		else
		{
			return Redirect::to('/');
		}
    }*/

 
//end of class
}
