<?php 
/**
* Base model for public Foretagskalendern
*/
class Base_Model{
	
	// will be added to this class variables
	public function __construct(array $attributes = null) {
		// dont do anything if we dont get an parameter.
		if ($attributes === null) return;
		// loop through our array set the keys and vlaues to our class variables
		foreach ($attributes as $key => $value) {
				if ($key == "timeReport" && strlen($value) == 1 ) {
					$value = "0".$value;
				}
				$this->$key = $value;
		}
	}

	function fiscal_year_to_declaration(){
		switch ($this->financialStatement) {
			case '1':
				$this->declaration_day = '01';
				$this->declaration_month = 'nov';
				break;
			case '2':
				$this->declaration_day = '11';
				$this->declaration_month = 'dec';
				break;
			case '3':
				$this->declaration_day = '01';
				$this->declaration_month = 'mar';
				break;
			case '4':
				$this->declaration_day = '01';
				$this->declaration_month = 'jul';
				break;
			
			default:
				return;
				break;
		}
	}
}

 ?>