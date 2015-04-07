<?php

class OrderHelper {

	// Data members
	//
	//


//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////


	
//////////////////////////////////////////////////////////////////
//destructor
//////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////
//public fuctions

	public function createOrder(Account $account)
	{
		$orderDate = date('Ymd');
		$tableDate = date('Ym');
		
		if(!Schema::hasTable('ordered_items_'.$tableDate))
		{
			$query = 'CREATE TABLE IF NOT EXISTS ordered_items_'.$tableDate.' (CHECK (order_id > '.$tableDate.'01000 AND order_id < '.$tableDate.'32000)) INHERITS (ordered_items)';
			
			DB::unprepared($query);
			
			$orderId = ($orderDate * 1000) + 1;
			
			
		}
		else
		{
			$todaysHighestOrderId = DB::table('orders')->where('order_id', '>', $orderDate.'000')->select('order_id')->orderBy('order_id', 'DESC')->first();

			$orderId = (count($todaysHighestOrderId) > 0)? $todaysHighestOrderId->order_id : $orderDate * 1000;
			$orderId++;
		}
		
		$order = new Order;
		
		$order->order_id = $orderId;
		$order->account_id = $account->account_id;
		$order->save();
		
		return $order;

	}
	
	public function getSubtotal(Order $order)
	{
		
		$oiTable = 'ordered_items_'.substr($order->order_id, 0, 6);
		
		$items = DB::table($oiTable)
				  ->join('orders', $oiTable.'.order_id', '=', 'orders.order_id')
				  ->where($oiTable.'.order_id', '=', $order->order_id)
				  ->select($oiTable.'.code',
						   $oiTable.'.qty', 
						   $oiTable.'.msrp',
						   $oiTable.'.retailer_discount',
						   $oiTable.'.extra_discount',
						   $oiTable.'.tax')
				  ->orderBy('code', 'ASC')
				  ->get();
				  
		$subtotal = 0.00;
				  
		if(count($items) > 0)
		{
			
			foreach($items as $i)
			{
				$subtotal += ($i->msrp * (1 - ($i->retailer_discount * 0.01))) * (1 - ($i->extra_discount * 0.01)) * $i->qty;
			}
			
		}
		
		return sprintf("%01.2f", $subtotal);
		
	}
	
	public function getTaxes(Order $order, Account $account)
	{
		$tax1rate = $account->tax1;
		$tax2rate = $account->tax2;
		
		$oiTable = 'ordered_items_'.substr($order->order_id, 0, 6);
		
		$items = DB::table($oiTable)
				  ->join('orders', $oiTable.'.order_id', '=', 'orders.order_id')
				  ->where($oiTable.'.order_id', '=', $order->order_id)
				  ->select($oiTable.'.code',
						   $oiTable.'.qty', 
						   $oiTable.'.msrp',
						   $oiTable.'.retailer_discount',
						   $oiTable.'.extra_discount',
						   $oiTable.'.tax')
				  ->orderBy('code', 'ASC')
				  ->get();
		
		$tax1total = 0.00;
		$tax2total = 0.00;
		$taxTotal = 0.00;
				  
		if(count($items) > 0)
		{
			
			foreach($items as $i)
			{
				$subtotal = ($i->msrp * (1 - ($i->retailer_discount * 0.01))) * (1 - ($i->extra_discount * 0.01)) * $i->qty;
				
				if($tax1rate > 0 && $i->tax > 0) $tax1total += $subtotal * ($tax1rate * 0.01);
				if($tax2rate > 0 && $i->tax > 1) $tax2total += $subtotal * ($tax2rate * 0.01);
				
			}
			
		}
		
		$taxes['gst'] = sprintf("%01.2f", $tax1total);
		$taxes['pst'] = sprintf("%01.2f", $tax2total);
		$taxes['taxTotal'] = sprintf("%01.2f", ($tax1total + $tax2total));
		
		return $taxes;
		
	}

	public function getNumberOfItems(Order $order)
	{
		
		$oiTable = 'ordered_items_'.substr($order->order_id, 0, 6);
		
		$items = DB::table($oiTable)
				  ->join('orders', $oiTable.'.order_id', '=', 'orders.order_id')
				  ->where($oiTable.'.order_id', '=', $order->order_id)
				  ->select($oiTable.'.code',
						   $oiTable.'.qty', 
						   $oiTable.'.msrp',
						   $oiTable.'.retailer_discount',
						   $oiTable.'.extra_discount',
						   $oiTable.'.tax')
				  ->orderBy('code', 'ASC')
				  ->get();
				  
		$noi = 0;
				  
		if(count($items) > 0)
		{
			
			foreach($items as $i)
			{
				$noi += $i->qty;
			}
			
		}
		
		return $noi;
		
	}
		
	public function inOrder(Product $product, Order $order)
	{
		$oiTable = 'ordered_items_'.substr($order->order_id, 0, 6);
		
		$item = DB::table($oiTable)
				->where('order_id', '=', $order->order_id)
				->where('code', '=', $product->code)
				->select('qty')
				->first();
				
		return (count($item) > 0) ? $item->qty : 0;
		
	}
	
	public function getItems(Order $order)
	{
		
		$oiTable = 'ordered_items_'.substr($order->order_id, 0, 6);
		
		$items = DB::table($oiTable)
				  ->join('orders', $oiTable.'.order_id', '=', 'orders.order_id')
				  ->where($oiTable.'.order_id', '=', $order->order_id)
				  ->select($oiTable.'.code',
						   $oiTable.'.qty', 
						   $oiTable.'.msrp',
						   $oiTable.'.retailer_discount',
						   $oiTable.'.extra_discount',
						   $oiTable.'.tax')
				  ->orderBy('code', 'ASC')
				  ->get();
				  
		return $items;		

	}
	
	public function updateItem(Product $product, $qty = 0, $extra_discount = 0, Order $order)
	{
		$oiTable = 'ordered_items_'.substr($order->order_id, 0, 6);
		
		$inOrder = $this->inOrder($product, $order);
		
		if($qty > 0)
		{
			if($inOrder > 0)
			{
				DB::table($oiTable)
					->where('order_id', $order->order_id)
					->where('code', $product->code)
					->update(['qty' => $qty]);

			}
			else
			{

				DB::table($oiTable)->insert([
					'order_id' => $order->order_id,
					'code' => $product->code,
					'qty' => $qty,
					'msrp' => $product->msrp,
					'retailer_discount' => $product->retailer_discount,
					'extra_discount' => $extra_discount,
					'tax' =>$product->tax
					]);
			}
			
		}
		else
		{
			if($inOrder > 0) DB::table($oiTable)
								->where('order_id', $order->order_id)
								->where('code', $product->code)
								->delete();
		}
		
		$totalReserved = DB::table('ordered_items')
							->join('orders', 'ordered_items.order_id', '=', 'orders.order_id')
							->whereNull('date_sent')
							->where('code', $product->code)
							->sum('qty');
		
		$product->reserved = $totalReserved;
		
		$product->save();


	}


//////////////////////////////////////////////////////////////////
//private functions





}


?>
