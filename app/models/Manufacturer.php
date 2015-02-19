<?php

class Manufacturer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'manufacturers';
	protected $primaryKey = 'man_id';
	
	public function scopeJoinProducts($query, $manId)
	{
		return $query->join('products', function($join) use($manId)
		{
			$join->on('products.man_id', '=', 'manufacturers.man_id');
			
		})
		->where('man_id', '=', $man_id);
		
	}

}
