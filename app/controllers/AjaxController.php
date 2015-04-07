<?php

class AjaxController extends BaseController {
 
    /**
     * show a view with form to create settings
     */
    public function index() {
        return Redirect::to('/');
        //return View::make('catalogue.test');
    }
 
    /**
     * handle data posted by ajax request
     */
    public function update() {
		
		if(Auth::check())
		{
		
			//check if its our form
			if ( Session::token() !== Input::get( '_token' ) ) {
				return Response::json( array(
					'msg' => 'Unauthorized attempt to create setting'
				) );
			}
			
			$account = Account::findOrFail(Auth::id());
			
			$verb = Input::get( 'verb' );
			$code = Input::get( 'code' );
			$product = Product::findOrFail( $code );
			$qty = Input::get( $verb.'-'.$code );
			
			//$basket->updateItem($product, $qty);
			
			
			
			switch($verb)
			{
				case 'tt':
					$color = '#EC9923';
					$preorder = new Preorder($account);
					$preorder->updateItem($product, $qty);
					$value = $preorder->getNumberOfItems();
					break;
					
				case 'reserve':
					$color = '#D14642';
					$preorder = new Preorder($account);
					$preorder->updateItem($product, $qty);
					$value = $preorder->getNumberOfItems();
					break;
					
				case 'buy':
					$color = '#4EA64E';
					$basket = new Basket($account);
					$basket->updateItem($product, $qty);
					$value = '$'.$basket->getSubtotal();
					break;
			}
			
			//$input = implode('|', Input::all());
			
			$inputbg = ($qty > 0) ? $color : '#ffffff';
			$inputfg = ($qty > 0) ? '#ffffff' : '#000000';
			
			
			
			/*$action = Input::get( 'action' );
			$code = Input::get( 'code' );
			$qty = Input::get( 'qty' );*/
	 
			//.....
			//validate data
			//and then store it in DB
			//.....
			
			//DB::table('ajax')->insert([ 'data' => $setting_name.'~'.$setting_value.'~'.$action.'~'.$code.'~'.$qty]);
			//DB::table('ajax')->insert([ 'data' => $input.'~~~'.$qty]);
			
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
    }
 
//end of class
}
