<?php

class Subproductline extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'subproductlines';
	protected $primaryKey = 'subpl_id';
	
	public function scopeJoinProducts($query, $plId)
	{
		return $query->join('products', function($join) use($plId)
		{
			$join->on('products.pl_id', '=', 'productlines.pl_id');
			
		})
		->where('products.pl_id', '=', $plId);
		
	}
	

}
