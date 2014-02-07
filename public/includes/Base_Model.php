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
				if ($key == 'timeReport' && strlen($value) == 1 ) {
					$value = '0'.$value;
				}
				$this->$key = $value;
		}
	}
	function fiscal_year_to_declaration(){
		//maj-jun
		if ($this->fiscalYearEnd == '2013-05-31' ||
			$this->fiscalYearEnd == '2013-06-30') {
				if ($this->paperDec == 'no') {
					$this->declaration_day = '15';
					$this->declaration_month = 'jan';
				}//if paper yes paid last year	
		}//juli-aug 2013
		elseif ($this->fiscalYearEnd == '2013-07-31' ||
			$this->fiscalYearEnd == '2013-08-31') {
				if ($this->paperDec == 'yes') {
					$this->declaration_day = '01';
					$this->declaration_month = 'mar';
				}else{
					$this->declaration_day = '01';
					$this->declaration_month = 'apr';
				}
		}
		// sept-dec
		elseif ($this->fiscalYearEnd == '2013-09-30' ||
				$this->fiscalYearEnd == '2013-10-31' ||
				$this->fiscalYearEnd == '2013-11-30' ||
				$this->fiscalYearEnd == '2013-12-31') {
				if ($this->paperDec == 'yes') {
					$this->declaration_day = '01';
					$this->declaration_month = 'jul';
				}else{
					$this->declaration_day = '01';
					$this->declaration_month = 'aug';
				}
		}
		// elseif jan-apr
		elseif ($this->fiscalYearEnd == '2014-01-31' ||
			$this->fiscalYearEnd == '2014-02-28' ||
			$this->fiscalYearEnd == '2014-03-31' ||
			$this->fiscalYearEnd == '2014-04-30') {
				if ($this->paperDec == 'yes') {
					$this->declaration_day = '01';
					$this->declaration_month = 'nov';
				}else{
					$this->declaration_day = '01';
					$this->declaration_month = 'dec';
				}	
		}//if maj-juni
		elseif ($this->fiscalYearEnd == '2014-05-31' ||
				$this->fiscalYearEnd == '2014-06-30') {
					if ($this->paperDec == 'yes') {
						$this->declaration_day = '15';
						$this->declaration_month = 'dec';
					}//if no paper 2015-15-jan
		}
	}
	
	function set_moms_year(){
		switch ($this->fiscalYearEnd) {
			case '2013-05-31':
			case '2013-06-30':
				if ($this->eu == 'no') {
					if ($this->paperMoms == 'no') {
						$this->moms_payment_year = '17-jan';
					} // else 27dec last year
				}// if eu yes last year
				break;
			case '2013-07-31':
			case '2013-08-31':
				if ($this->eu == 'no') {
					if ($this->paperMoms == 'yes') {
						$this->moms_payment_year = '12-mar';
					}else{
						$this->moms_payment_year = '12-apr';	
					}
				}// if eu yes last year
				break;
			case '2013-09-30':
			case '2013-10-31':
			case '2013-11-30':
				// if eu yes and nov. no break if not.
				if ($this->eu == 'yes' && $this->fiscalYearEnd == '2013-11-30') {
					$this->moms_payment_year = '26-jan';
					break;
				}
			case '2013-12-31':
				if ($this->eu == 'yes' && $this->fiscalYearEnd == '2013-12-31') {
					$this->moms_payment_year = '26-feb';
					break;
				}elseif ($this->paperMoms == 'yes' && $this->eu == 'no') {
					$this->moms_payment_year = '12-jul';
				}// have to check otherwise nov and okt could be wrong
				elseif($this->eu == 'no'){
					$this->moms_payment_year = '17-aug';
				}
				break;
			// check all if eu then 2 month ahead
			//otherwise all have same date, depending on paper/electrnoic 
			case '2014-01-31':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-mar';
					break;
				}
			case '2014-02-28':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-apr';
					break;
				}
			case '2014-02-29':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-maj';
					break;
				}
			case '2014-03-31':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-jun';
					break;
				}
			case '2014-04-30':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-jul';
					break;
				}
				if ($this->paperMoms == 'no') {
					$this->moms_payment_year = '12-dec';
				}else{
					$this->moms_payment_year = '12-nov';
				}
				break;
			default:
				return;
				break;
		}
	}
	function date_conversion($month){
		switch ($month) {
			case '01':
				return 'jan';
				break;
			case '02':
				return 'feb';
				break;
			case '03':
				return 'mar';
				break;
			case '04':
				return 'apr';
				break;
			case '05':
				return 'maj';
				break;
			case '06':
				return 'jun';
				break;
			case '07':
				return 'jul';
				break;
			case '08':
				return 'aug';
				break;
			case '09':
				return 'sep';
				break;
			case '10':
				return 'okt';
				break;
			case '11':
				return 'nov';
				break;
			case '12':
				return 'dec';
				break;
			default:
				return;	
				break;
		}	
	}
	function date_convertion_to_number($month){
		switch ($month) {
			case 'jan':
				return '01';
				break;
			case 'feb':
				return '02';
				break;
			case 'mar':
				return '03';
				break;
			case 'apr':
				return '04';
				break;
			case 'maj':
				return '05';
				break;
			case 'jun':
				return '06';
				break;
			case 'jul':
				return '07';
				break;
			case 'aug':
				return '08';
				break;
			case 'sep':
				return '09';
				break;
			case 'okt':
				return '10';
				break;
			case 'nov':
				return '11';
				break;
			case 'dec':
				return '12';
				break;
			default:
				return;	
				break;
		}	
	}
}
?>