<?php

class Order extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';
	protected $primaryKey = 'order_id';
	
	/*public function scopeMenuOrderAscending($query)
	{
		return $query->orderBy('menuOrder', 'ASC');
	}*/
	
	public function scopeAccountid($query, $accountId)
	{
		return $query->where('account_id', '=', $accountId);
	}
	
	public function scopeSubmitted($query)
	{
		return $query->whereNotNull('date_submitted');
	}
	
	public function scopeNotsubmitted($query)
	{
		return $query->whereNull('date_submitted');
	}
	
	public function scopeSent($query)
	{
		return $query->whereNotNull('date_sent');
	}
	
	public function scopeNotsent($query)
	{
		return $query->whereNull('date_sent');
	}
}
