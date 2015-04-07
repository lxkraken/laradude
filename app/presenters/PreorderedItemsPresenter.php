<?php
 
class PreorderedItemsPresenter  {
 
	protected $poItems;
	
	public function __construct($items = null)
	{
		if($items)
		{
			$x = 0;
			
			$locale = App::getLocale();
			
			foreach($items as $i)
			{
				$this->poItems[$x]['code'] = $i->code;
				
				$product = Product::findOrFail($i->code);
				
				$pp = new ProductPresenter($product);
				
				$poItem = $pp->getProduct();
				
				$this->poItems[$x]['name'] = $poItem['name'];
				$this->poItems[$x]['qty'] = $i->qty;
				$this->poItems[$x]['link'] = (strlen($poItem['description']) > 1) ? '/product/'.$poItem['code'] : '';
				$this->poItems[$x]['msrp'] = sprintf("%01.2f", $poItem['msrp']);
				$this->poItems[$x]['release_date'] = $poItem['release_date'];
				
				$dateBits = explode('-', $poItem['release_date']);
				
				//$fullDate = 'le '.$dateBits[2].' '.$this->getFrenchMonth($dateBits[1]).', '.$dateBits[0];
				
				$season = strtolower($this->getFrenchSeason($dateBits[1])).', '.$dateBits[0];
				
				switch($poItem['available'])
				{
					case 0:
						$this->poItems[$x]['status'] = 'Disponible!';
						break;
						
					case 1:
						$this->poItems[$x]['status'] = 'En transit - p&eacute;vu pour '.$season;
						break;
						
					case 2:
						//$this->poItems[$x]['status'] = ($poItem['release_date'] > date('Y-m-d')) ? 'En commande - p&eacute;vu pour '.$season : 'En commande';
						$this->poItems[$x]['status'] = 'En commande - p&eacute;vu pour '.$season;
						break;
						
					case 3:
						$this->poItems[$x]['status'] = 'En r&eacute;impression';
						break;
						
					case 4:
						$this->poItems[$x]['status'] = 'Disponible '.$season;
						break;
						
					case 5:
						$this->poItems[$x]['status'] = 'Fini pour toute la vie';
						break;
						
				}		

				$x++;
			}
			

		}

		
	}
	
	public function getPreorderedItems()
	{
		return $this->poItems;
	}
	
	
/*********************************************
 * Private functions
 */
 
	private function getFrenchMonth($month)
	{
		switch ($month)
		{
			case '01':
				return 'janvier';
				break;
			
			case '02':
				return 'f&eacute;vrier';
				break;
				
			case '03':
				return 'mars';
				break;
				
			case '04':
				return 'avril';
				break;
				
			case '05':
				return 'mai';
				break;
				
			case '06':
				return 'juin';
				break;
				
			case '07':
				return 'juillet';
				break;
				
			case '08':
				return 'ao&ucirc;t';
				break;
				
			case '09':
				return 'septembre';
				break;
				
			case '10':
				return 'octobre';
				break;
				
			case '11':
				return 'novembre';
				break;
				
			case '12':
				return 'd&eacute;cembre';
				break;
			
		}
			
	}

	private function getFrenchSeason($month) {
		
		switch($month) {
			
			case(12):
			case(1):
			case(2):
				$output = 'Hiver';
				break;
			
			case(3):
			case(4):
			case(5):
				$output = 'Printemps';
				break;
			
			case(6):
			case(7):
			case(8):
				$output = '&Eacute;t&eacute;';
				break;
				
			case(9):
			case(10):
			case(11):
				$output = 'Automne';
				break;
				
		}
		
		return $output;
		
	}
	
}
