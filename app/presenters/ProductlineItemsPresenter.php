<?php
 
class ProductlineItemsPresenter  {
 
	protected $productline;
	protected $account;
	protected $rank;
	protected $productlineItems;
	
	public function __construct(Productline $productline, $prodlang, Account $account = null)
	{
		$this->productline = $productline;
		$this->account = $account;
		$this->rank = ($account) ? $this->account->rank : 0;
		
		if(strlen($this->productline->header_product) > 1)
		{
			$headerCodes = explode('~', $this->productline->header_product);
			
		}
		elseif ($this->productline->header_product == 1)
		{
			$headerCodes = 'first';
		}
		else
		{
			$headerCodes = 'none';
		}
		
		
		if($this->rank > 1)
		{
			
			$products = ($prodlang == 'e' || $prodlang == 'f') ?
					DB::table('products')
						->where('pl_id', $productline->pl_id)
						->where(
						function($query) use ($prodlang)
						{
							$query->where('prod_lang', $prodlang)
								   ->orWhere('prod_lang', 'm');
						})
						->select('code', 'subpl_id')
						->orderBy('prod_type')
						->orderBy('code')
						->get()
					:
					DB::table('products')
						->where('pl_id', $productline->pl_id)
						->where('prod_lang', $prodlang)
						->select('code', 'subpl_id')
						->orderBy('prod_type')
						->orderBy('code')
						->get();
		}
		else
		{
			$products = ($prodlang == 'e' || $prodlang == 'f') ?
					DB::table('products')
						->where('pl_id', $productline->pl_id)
						->where('display', true)
						->where(
						function($query) use ($prodlang)
						{
							$query->where('prod_lang', $prodlang)
								   ->orWhere('prod_lang', 'm');
						})
						->select('code', 'subpl_id')
						->orderBy('prod_type')
						->orderBy('code')
						->get()
					:
					DB::table('products')
						->where('pl_id', $productline->pl_id)
						->where('display', true)
						->where('prod_lang', $prodlang)
						->select('code', 'subpl_id')
						->orderBy('prod_type')
						->orderBy('code')
						->get();
		}
		
		$x = 0;
		
		foreach($products as $p)
		{
			$productPresenter = new ProductPresenter(Product::findOrFail($p->code), $this->account);

			if(is_array($headerCodes) && $prodlang != 'dice' && in_array($p->code, $headerCodes))
			{
				$this->productlineItems['header_product'][] = $productPresenter->getProduct();
				/*if(in_array($p->code, $headerCodes))
				{
					
					$this->productlineItems['header_product'][] = $productPresenter->getProduct();
				}*/
			}
			elseif ($headerCodes == 'first' && $x == 0 && $prodlang != 'dice')
			{
				if(strtoupper(substr($p->code, -1, 1)) == 'D' && count($products) > 1)
				{
					$this->productlineItems['demo'][] = $productPresenter->getProduct(); 
				}
				else
				{
					$this->productlineItems['header_product'][] = $productPresenter->getProduct();
					$x++;
				}
			}
			else
			{
				if(strtoupper(substr($p->code, -1, 1)) == 'D') {
					$this->productlineItems['demo'][] = $productPresenter->getProduct();
				}
				else
				{
					if($p->subpl_id > 0)
					{

						if(!isset($this->productlineItems['subproductlines'][$p->subpl_id]))
						{
							$subplPresenter = new SubproductlinePresenter(Subproductline::findOrFail($p->subpl_id));
							
							$this->productlineItems['subproductlines'][$p->subpl_id] = $subplPresenter->getSubproductline();
						}
						
						$product = $productPresenter->getProduct();
						
						$this->productlineItems['subproductlines'][$p->subpl_id]['open'] = ($product['inBasket'] > 0 || $product['inPreorder'] > 0) ? 'in' : '';
						
						$this->productlineItems['subproductlines'][$p->subpl_id]['products'][] = $product;


					}
					else
					{
						$this->productlineItems['base'][] = $productPresenter->getProduct();
					}
				}
				
			}

			
		}
		
		if(isset($this->productlineItems['subproductlines'])) $this->array_sort_by_column($this->productlineItems['subproductlines'], 'name');

		
	}
	
	public function getProductlineItems()
	{
		return $this->productlineItems;
	}

	private function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}

		array_multisort($sort_col, $dir, $arr);
		
		//USE:
		//array_sort_by_column($array, 'order');
	}
}

