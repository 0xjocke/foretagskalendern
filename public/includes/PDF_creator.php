<?php 
	/**
	* PDF Creator class
	*/
	require_once 'Base_Model.php';
	class PDF_creator extends Base_Model{
		// From input field
		public $name, $momsperiod, $timeReport;
		public $fiscalYearStart, $fiscalYearEnd, $extra, $extraDate;
		public $moms_payment_year;
		
		// generated from this class
		public $declaration_day, $declaration_month;
		public $html, $guid;
		// public $extra_day, $extra_month;
		
		
		function __construct(array $attributes){
			parent::__construct($attributes);
			$this->html = file_get_contents('../views/pdf/pdf.html');
			$this->guid = uniqid();
		}
		
		function get_guid(){
			return $this->guid;
		}
		function add_name(){
			$this->html = str_replace('%name%', $_POST['name'], $this->html);
		}
		function add_time_report(){
			$this->html = str_replace('<td><!--fk-'.$this->timeReport.'-', "<td class='fk-todo'>Tidsrapport<!--fk-".$this->timeReport."-", $this->html);
		}
		
		function add_momsperiod_month(){
			$this->html = str_replace('<td><!--fk-17-jan', "<td class='fk-todo'>Moms<!--fk-17-jan", $this->html);
			$this->html = str_replace('<td><!--fk-17-aug', "<td class='fk-todo'>Moms<!--fk-17-aug", $this->html);
			$this->html = str_replace('<td><!--fk-12-feb', "<td class='fk-todo'>Moms<!--fk-12-feb", $this->html);
			$this->html = str_replace('<td><!--fk-12-mar', "<td class='fk-todo'>Moms<!--fk-12-mar", $this->html);
			$this->html = str_replace('<td><!--fk-12-apr', "<td class='fk-todo'>Moms<!--fk-12-apr", $this->html);
			$this->html = str_replace('<td><!--fk-12-maj', "<td class='fk-todo'>Moms<!--fk-12-maj", $this->html);
			$this->html = str_replace('<td><!--fk-12-jun', "<td class='fk-todo'>Moms<!--fk-12-jun", $this->html);
			$this->html = str_replace('<td><!--fk-12-jul', "<td class='fk-todo'>Moms<!--fk-12-jul", $this->html);
			$this->html = str_replace('<td><!--fk-12-sep', "<td class='fk-todo'>Moms<!--fk-12-sep", $this->html);
			$this->html = str_replace('<td><!--fk-12-okt', "<td class='fk-todo'>Moms<!--fk-12-okt", $this->html);
			$this->html = str_replace('<td><!--fk-12-nov', "<td class='fk-todo'>Moms<!--fk-12-nov", $this->html);
			$this->html = str_replace('<td><!--fk-12-dec', "<td class='fk-todo'>Moms<!--fk-12-dec", $this->html);
		}
		function add_momsperiod_year(){
			$this->set_moms_year();
			$this->html = str_replace('<td><!--fk-'. $this->moms_payment_year, "<td class='fk-todo'>Moms<!--fk-" . $this->moms_payment_year, $this->html);

		}
		function add_momsperiod_quarter(){
			$this->html = str_replace('<td><!--fk-12-feb', "<td class='fk-todo'>Moms<!--fk-12-feb", $this->html);
			$this->html = str_replace('<td><!--fk-12-maj', "<td class='fk-todo'>Moms<!--fk-12-maj", $this->html);
			$this->html = str_replace('<td><!--fk-18-aug', "<td class='fk-todo'>Moms<!--fk-18-aug", $this->html);
			$this->html = str_replace('<td><!--fk-12-nov', "<td class='fk-todo'>Moms<!--fk-12-nov", $this->html);
		}
		function add_moms_and_time_17(){
			$this->html = str_replace('<td><!--fk-17-jan', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-17-jan", $this->html);
			$this->html = str_replace('<td><!--fk-17-aug', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-17-aug", $this->html);
		}
		function add_moms_and_time_12(){
			$this->html = str_replace('<td><!--fk-12-feb', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-feb", $this->html);
			$this->html = str_replace('<td><!--fk-12-mar', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-mar", $this->html);
			$this->html = str_replace('<td><!--fk-12-apr', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-apr", $this->html);
			$this->html = str_replace('<td><!--fk-12-maj', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-maj", $this->html);
			$this->html = str_replace('<td><!--fk-12-jun', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-jun", $this->html);
			$this->html = str_replace('<td><!--fk-12-jul', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-jul", $this->html);
			$this->html = str_replace('<td><!--fk-12-sep', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-sep", $this->html);
			$this->html = str_replace('<td><!--fk-12-okt', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-okt", $this->html);
			$this->html = str_replace('<td><!--fk-12-nov', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-nov", $this->html);
			$this->html = str_replace('<td><!--fk-12-dec', "<td class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-dec", $this->html);
		}
		
		function add_declaration(){
			$this->fiscal_year_to_declaration();
			if ($this->declaration_day == $this->timeReport ) {
				$this->html = str_replace('<!--fk-' . $this->declaration_day . '-' . $this->declaration_month,',<br> Deklaration <!--', $this->html);
			}else{
				$this->html = str_replace('<td><!--fk-'.$this->declaration_day.'-'.$this->declaration_month,"<td class='fk-todo'>Deklaration <!--", $this->html);
			}	
		}
	
		function add_extra(){
			// get month with 0
			$extra_day = substr($this->extraDate, 8);
			//send in number month and get abr, i.e. 01 = 'jan'
			$extra_month = $this->date_conversion(substr($this->extraDate, 5, 2));
			//if day is 12, 18, same as timereport, same as declaratuion, add without adding fk-todo class.
			//else add data and fk-todo class.
			if ($extra_day == 12 || $extra_day == 17 || $extra_day == $this->timeReport) {
				$this->html = str_replace('<!--fk-'.$extra_day.'-'.$extra_month, ',<br>' . $this->extra . "<!--".$extra_day.'-'.$extra_month , $this->html);
			}elseif ($extra_day == $this->declaration_day && $extra_month == $this->declaration_month) {
				$this->html = str_replace('<!--fk-'.$extra_day.'-'.$extra_month, ',<br>' . $this->extra . "<!--".$extra_day.'-'.$extra_month , $this->html);
			}
			else{
				$this->html = str_replace('<td><!--fk-'.$extra_day.'-'.$extra_month, "<td class='fk-todo'>". $this->extra . '<!--' , $this->html);
			}

		}
		function put_contents(){
			file_put_contents('../views/pdf/build/pdf'.$this->guid.'.html', $this->html);
		}


	}



 ?>