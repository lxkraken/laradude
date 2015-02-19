<?php

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
	protected $primaryKey = 'code';
	
	/*public function scopeJoinManufacturers($query, $manId)
	{
		return $query->join('manufacturers', function($join) use($manId)
		{
			$join->on('products.man_id', '=', 'manufacturers.man_id');
			
		})
		->where('man_id', '=', $man_id);
		
	}
	
	public function scopeJoinProductlines($query)
	{
		return $query->join('productlines', function($join)
		{
			$join->on('products.pl_id', '=', 'productlines.pl_id');
			
		});
		
	}*/
	
	public function scopeProductline($query, $plid)
	{
		return $query->wherePlId($plid);
	}

	public function scopeSubproductline($query, $subplid)
	{
		return $query->whereSubplId($subplid);
	}
	
	public function scopeDisplay($query)
	{
		return $query->whereDisplay('true');
	}

	public function scopeProdlang($query, $prodlang)
	{
		if($prodlang == 'e' || $prodlang == 'f')
		{
			return $query->where(function($query) use($prodlang) {
				return $query->where('prod_lang', '=', $prodlang)
							 ->orWhere('prod_lang', '=', 'm');
			});
		}
		else
		{
			return $query->whereProdLang($prodlang);
			
		}
		
	}


}
