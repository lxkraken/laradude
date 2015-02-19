<?php

class Productline extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'productlines';
	protected $primaryKey = 'pl_id';
	
	public function scopeJoinProducts($query, $plId)
	{
		return $query->join('products', function($join) use($plId)
		{
			$join->on('products.pl_id', '=', 'productlines.pl_id');
			
		})
		->where('products.pl_id', '=', $plId);
		
	}
	

}
