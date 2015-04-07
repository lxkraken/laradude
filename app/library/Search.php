<?php

class Search {

	// Data members
	//
	private $searchTerms = array();
	private $score = array();
	/*private $lang;*/
	protected $searchQuery;
	protected $rank;


//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////
	public function __construct($searchQuery, $rank = 0) {
		
		$this->rank = $rank;
		
		$searchQuery = str_replace('\'', '', $searchQuery);
		$searchQuery = str_replace(';', '', $searchQuery);
		$searchQuery = str_replace('"', '', $searchQuery);
		$searchQuery = trim(urldecode($this->removeAccents($searchQuery)));
		$sterms = explode(" ", $searchQuery);
		$this->searchQuery = str_replace(' ', '.', $searchQuery);
		$this->searchTerms = array_values($sterms);

	}

	
//////////////////////////////////////////////////////////////////
//destructor
//////////////////////////////////////////////////////////////////
	public function __destruct(){
		unset($this->score);
		unset($this->searchTerms);
	}
//////////////////////////////////////////////////////////////////
//public fuctions

	public function getSearchResults() {
		
		if($this->rank < 2) $queryAdd = ' AND display = TRUE';
        
       
        $baseScore = count($this->searchTerms);
        
        /* Code searches
         * 
         * Exact match: 3 points
         * Partial Matches: 1 point
         * 
         * Remove accents.
         * 
         * Order by base game, popularity.
         ***/
         
         $this->doSearch(' WHERE code ~* ? AND prod_type = 1', $this->searchQuery, 3 + $baseScore);
         $this->doSearch(' WHERE code ~* ? ', $this->searchQuery, 1 + $baseScore);


        /* Name searches
         * 
         * Exact Match: 3 points
         * Partial Match: 1 points
         * 
         * Explode the search query if it contains spaces. Immediately clean search terms.
         * 
         * Order by base game, popularity.
        *****/
        
        $this->doSearch(' WHERE f_name ~* ? AND prod_type = 1', $this->francoSearch($this->searchQuery), 5 + $baseScore);
        $this->doSearch(' WHERE e_name ~* ? AND prod_type = 1', $this->searchQuery, 5 + $baseScore);


        $this->doSearch(' WHERE f_name ~* ?', $this->francoSearch($this->searchQuery), 5 + $baseScore);
        $this->doSearch(' WHERE e_name ~* ?', $this->searchQuery, 5 + $baseScore);

		if(count($this->searchTerms) > 1) {

			foreach($this->searchTerms as $searchTerm) {
				
				if(strlen($searchTerm) > 1)
				{
					$this->doSearch(' WHERE f_name ~* ? AND prod_type = 1', $this->francoSearch($searchTerm), 2 + $baseScore);
					$this->doSearch(' WHERE e_name ~* ? AND prod_type = 1', $searchTerm, 2 + $baseScore);
					
					$this->doSearch(' WHERE f_name ~* ?', $this->francoSearch($searchTerm), 1 + $baseScore);
					$this->doSearch(' WHERE e_name ~* ?', $searchTerm.'', 1 + $baseScore);

				}

			}
			
		}
		
		arsort($this->score);
		
		$score = array_slice($this->score, 0, 20);
		
		return($score);
		
	}


//////////////////////////////////////////////////////////////////
//private functions

	//private function cleanSearchTerm($searchTerm) {
	private function francoSearch($searchTerm) {
		
		$input = strtolower(trim($searchTerm));
	
		for($x=0;$x<strlen($input);$x++) {
			
			if($input{$x} == 'a') {
				$sbits[] = '(a|â|à)';
			} else if($input{$x} == 'e') {
				$sbits[] = '(e|ê|è|é)';
			} else if($input{$x} == 'i') {
				$sbits[] = '(i|ï|î)';
			} else if($input{$x} == 'o') {
				$sbits[] = '(o|ô)';
			} else if ($input{$x} == 'u') {
				$sbits[] = '(u|û|ù|ü)';
			} else if ($input{$x} == 'c') {
				$sbits[] = '(c|ç)';
			} else {
				$sbits[] = $input[$x];
			}
		
		}
		
		$sterm = implode('', $sbits);

		return $sterm;

	}
	
	private function doSearch($where, $q, $pointValue=1) {
		
		//if(!$pgconn) require('config/pgdb.inc');
		
		if($this->rank < 2) $queryAdd = ' AND display = TRUE';
		
		//$query = 'SELECT code FROM products'.$where.' '.$queryAdd.' AND code NOT ILIKE \'%D\' AND available < 5 ORDER BY code ASC;';
		
		$search = DB::select('SELECT code FROM products'.$where.' '.$queryAdd.' AND code NOT ILIKE \'%D\' AND available < 5 ORDER BY code ASC;', array($q));

        foreach($search as $s)
        {
			if(!isset($this->score[$s->code])) $this->score[$s->code] = 0;
			$this->score[$s->code] += $pointValue;
		}

	}


	private function removeAccents($string) {
		if ( !preg_match('/[\x80-\xff]/', $string) )
			return $string;

		$chars = array(
		// Decompositions for Latin-1 Supplement
		chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
		chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
		chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
		chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
		chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
		chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
		chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
		chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
		chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
		chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
		chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
		chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
		chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
		chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
		chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
		chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
		chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
		chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
		chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
		chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
		chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
		chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
		chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
		chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
		chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
		chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
		chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
		chr(195).chr(191) => 'y',
		// Decompositions for Latin Extended-A
		chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
		chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
		chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
		chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
		chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
		chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
		chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
		chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
		chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
		chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
		chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
		chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
		chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
		chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
		chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
		chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
		chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
		chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
		chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
		chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
		chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
		chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
		chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
		chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
		chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
		chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
		chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
		chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
		chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
		chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
		chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
		chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
		chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
		chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
		chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
		chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
		chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
		chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
		chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
		chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
		chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
		chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
		chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
		chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
		chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
		chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
		chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
		chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
		chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
		chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
		chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
		chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
		chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
		chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
		chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
		chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
		chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
		chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
		chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
		chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
		chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
		chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
		chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
		chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
		);

		$string = strtr($string, $chars);

		return $string;
	}

}


?>
