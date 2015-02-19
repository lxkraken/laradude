<?php

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
	protected $primaryKey = 'cat_id';
	
	/*public function scopeMenuOrderAscending($query)
	{
		return $query->orderBy('menuOrder', 'ASC');
	}*/
	
	

}
