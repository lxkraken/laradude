<?php

class Productline extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'productlines';
	protected $primaryKey = 'pl_id';
	
/*	public function scopeJoinProducts($query)
	{
		return $query->join('products', function($join)
		{
			$join->on('products.pl_id', '=', 'productlines.pl_id');
			
		})
		->distinct();
		
	}
	
	//Only works after joining with the products table
	public function scopeDisplay($query, $display)
	{
		return $query->where('display', $display);
	}
	
	//Only works after joining with the products table
	public function scopeCategory($query, $catId)
	{
		return $query->where('products.cat_id', $catId);
	}
	
	//Only works after joining with the products table
	public function scopeSection($query, $section)
	{
		if($section == 'e' || $section == 'f')
		{
			return $query->where(function($nquery) use ($section)
					  {
						  $nquery->where('products.prod_lang', '=', $section)
							    ->orWhere('products.prod_lang', '=', 'm');
					  });
		}
		else
		{
			return $query->where('products.prod_lang', $section);

		}
	}*/
}
