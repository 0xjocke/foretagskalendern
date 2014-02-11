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
		//05-06
		if ($this->fiscalYearEnd == '2013-05-31' ||
			$this->fiscalYearEnd == '2013-06-30') {
				if ($this->paperDec == 'no') {
					$this->declaration_day = '15';
					$this->declaration_month = '01';
				}//if paper yes paid last year	
		}//07i-08 2013
		elseif ($this->fiscalYearEnd == '2013-07-31' ||
			$this->fiscalYearEnd == '2013-08-31') {
				if ($this->paperDec == 'yes') {
					$this->declaration_day = '01';
					$this->declaration_month = '03';
				}else{
					$this->declaration_day = '01';
					$this->declaration_month = '04';
				}
		}
		// 09t-12
		elseif ($this->fiscalYearEnd == '2013-09-30' ||
				$this->fiscalYearEnd == '2013-10-31' ||
				$this->fiscalYearEnd == '2013-11-30' ||
				$this->fiscalYearEnd == '2013-12-31') {
				if ($this->paperDec == 'yes') {
					$this->declaration_day = '01';
					$this->declaration_month = '07';
				}else{
					$this->declaration_day = '01';
					$this->declaration_month = '08';
				}
		}
		// elseif 01-04
		elseif ($this->fiscalYearEnd == '2014-01-31' ||
				$this->fiscalYearEnd == '2014-02-28' ||
				$this->fiscalYearEnd == '2014-03-31' ||
				$this->fiscalYearEnd == '2014-04-30') {
				if ($this->paperDec == 'yes') {
					$this->declaration_day = '01';
					$this->declaration_month = '11';
				}else{
					$this->declaration_day = '01';
					$this->declaration_month = '12';
				}	
		}//if 05-06i
		elseif ($this->fiscalYearEnd == '2014-05-31' ||
				$this->fiscalYearEnd == '2014-06-30') {
					if ($this->paperDec == 'yes') {
						$this->declaration_day = '15';
						$this->declaration_month = '12';
					}//if no paper 2015-15-01
		}
	}
	
	function set_moms_year(){
		switch ($this->fiscalYearEnd) {
			case '2013-05-31':
			case '2013-06-30':
				if ($this->eu == 'no') {
					if ($this->paperMoms == 'no') {
						$this->moms_payment_year = '17-01';
					} // else 27dec last year
				}// if eu yes last year
				break;
			case '2013-07-31':
			case '2013-08-31':
				if ($this->eu == 'no') {
					if ($this->paperMoms == 'yes') {
						$this->moms_payment_year = '12-03';
					}else{
						$this->moms_payment_year = '12-04';	
					}
				}// if eu yes last year
				break;
			case '2013-09-30':
			case '2013-10-31':
			case '2013-11-30':
				// if eu yes and 11. no break if not.
				if ($this->eu == 'yes' && $this->fiscalYearEnd == '2013-11-30') {
					$this->moms_payment_year = '26-01';
					break;
				}
			case '2013-12-31':
				if ($this->eu == 'yes' && $this->fiscalYearEnd == '2013-12-31') {
					$this->moms_payment_year = '26-02';
					break;
				}elseif ($this->paperMoms == 'yes' && $this->eu == 'no') {
					$this->moms_payment_year = '12-07';
				}// have to check otherwise 11 and 10 could be wrong
				elseif($this->eu == 'no' || $this->paperMoms == 'no'){
					$this->moms_payment_year = '17-08';
				}
				break;
			// check all if eu then 2 month ahead
			//otherwise all have same date, depending on paper/electrnoic 
			case '2014-01-31':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-03';
					break;
				}
			case '2014-02-28':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-04';
					break;
				}
			case '2014-02-29':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-05';
					break;
				}
			case '2014-03-31':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-06';
					break;
				}
			case '2014-04-30':
				if ($this->eu == 'yes') {
					$this->moms_payment_year = '26-07';
					break;
				}
				if ($this->paperMoms == 'no') {
					$this->moms_payment_year = '12-12';
				}else{
					$this->moms_payment_year = '12-11';
				}
				break;
			default:
				return;
				break;
		}
	}
	public function num_to_letters_month($month){
		switch ($month) {
			case '01':
				return 'Januari';
				break;
			case '02':
				return 'Februari';
				break;
			case '03':
				return 'Mars';
				break;
			case '04':
				return 'April';
				break;
			case '05':
				return 'Maj';
				break;
			case '06':
				return 'Juni';
				break;
			case '07':
				return 'Juli';
				break;
			case '08':
				return 'Augusti';
				break;
			case '09':
				return 'September';
				break;
			case '10':
				return 'Oktober';
				break;
			case '11':
				return 'November';
				break;
			case '12':
				return 'December';
				break;
		}
	}
}
?>