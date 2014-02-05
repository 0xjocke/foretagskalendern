<?php 
	/**
	* PDF Creator class
	*/
	class PDF_creator extends Base_Model{
		public $name, $momsperiod, $financialStatement;
		public $timeReport, $extra, $extraDate;
		public $declaration_day, $declaration_month;
		public $html, $guid;
		
		
		function __construct(array $attributes){
			parent::__construct($attributes);
			$this->html = file_get_contents("../views/pdf/pdf.html");
			$this->guid = uniqid();
		}
		
		function get_guid(){
			return $this->guid;
		}
		function add_name(){
			$this->html = str_replace('%name%', $_POST['name'], $this->html);
		}
		function add_time_report(){
			$this->html = str_replace("<td><!--fk-".$this->timeReport."-", "<td class='fk-todo'>Tidsrapport<!--fk-".$this->timeReport."-", $this->html);
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
			$this->html = str_replace('<td><!--fk-26-feb', "<td class='fk-todo'>Moms<!--fk-26-feb", $this->html);

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
				$this->html = str_replace('<!--fk-'.$this->declaration_day.'-'.$this->declaration_month,',<br> Deklaration <!--', $this->html);
			}else{
				$this->html = str_replace('<td><!--fk-'.$this->declaration_day.'-'.$this->declaration_month,"<td class='fk-todo'>Deklaration <!--", $this->html);
			}	
		}
	
		function add_extra($date, $extra){
			$day = substr($date, 8);
			$month = substr($date, 5,2);
			switch ($month) {
				case '01':
					$month = 'jan';
					break;
				case '02':
					$month = 'feb';
					break;
				case '03':
					$month = 'mar';
					break;
				case '04':
					$month = 'apr';
					break;
				case '05':
					$month = 'maj';
					break;
				case '06':
					$month = 'jun';
					break;
				case '07':
					$month = 'jul';
					break;
				case '08':
					$month = 'aug';
					break;
				case '09':
					$month = 'sep';
					break;
				case '10':
					$month = 'okt';
					break;
				case '11':
					$month = 'nov';
					break;
				case '12':
					$month = 'dec';
					break;
				default:
					return;	
					break;
			}
			//if day is 12, 18, same as timereport, same as declaratuion, add without adding fk-todo class.
			//else add data and fk-todo class.
			if ($day == 12 || $day == 17 || $day == $this->timeReport || $day == $this->financialtime[0] && $month == $this->financialtime[1]) {
				$this->html = str_replace('<!--fk-'.$day.'-'.$month, ',<br>' . $extra . "<!--".$day.'-'.$month , $this->html);
			}else{
				$this->html = str_replace('<td><!--fk-'.$day.'-'.$month, "<td class='fk-todo'>". $extra . "<!--" , $this->html);
			}

		}
		function put_contents(){
			file_put_contents('../views/pdf/build/pdf'.$this->guid.'.html', $this->html);
		}


	}



 ?>