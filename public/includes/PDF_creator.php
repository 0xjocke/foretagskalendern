<?php 
	/**
	* PDF Creator class
	*/
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
			$this->html = str_replace('<td><div><!--fk-'.$this->timeReport.'-', "<td><div class='fk-todo'>Tidsrapport<!--fk-".$this->timeReport."-", $this->html);
		}
		
		function add_momsperiod_month(){
			$this->html = str_replace('<td><div><!--fk-17-01', "<td><div class='fk-todo'>Moms för Nov<!--fk-17-01", $this->html);
			$this->html = str_replace('<td><div><!--fk-17-08', "<td><div class='fk-todo'>Moms för Jun<!--fk-17-08", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-02', "<td><div class='fk-todo'>Moms för Dec<!--fk-12-02", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-03', "<td><div class='fk-todo'>Moms för Jan<!--fk-12-03", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-04', "<td><div class='fk-todo'>Moms för Feb<!--fk-12-04", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-05', "<td><div class='fk-todo'>Moms för Mar<!--fk-12-05", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-06', "<td><div class='fk-todo'>Moms för Apr<!--fk-12-06", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-07', "<td><div class='fk-todo'>Moms för Maj<!--fk-12-07", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-09', "<td><div class='fk-todo'>Moms för Jul<!--fk-12-09", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-10', "<td><div class='fk-todo'>Moms för Aug<!--fk-12-10", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-11', "<td><div class='fk-todo'>Moms för Sep<!--fk-12-11", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-12', "<td><div class='fk-todo'>Moms för Okt<!--fk-12-12", $this->html);
		}
		function add_momsperiod_year(){
			$this->set_moms_year();
			$this->html = str_replace('<td><div><!--fk-'. $this->moms_payment_year, "<div  class='fk-todo'><td>Moms<!--fk-" . $this->moms_payment_year, $this->html);

		}
		function add_momsperiod_quarter(){
			$this->html = str_replace('<td><div><!--fk-12-02', "<td><div class='fk-todo'>Moms för kvartal 4<!--fk-12-02", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-05', "<td><div class='fk-todo'>Moms för kvartal 1<!--fk-12-05", $this->html);
			$this->html = str_replace('<td><div><!--fk-18-08', "<td><div class='fk-todo'>Moms för kvartal 2<!--fk-18-08", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-11', "<td><div class='fk-todo'>Moms för kvartal 3<!--fk-12-11", $this->html);
		}
		function add_moms_and_time_17(){
			$this->html = str_replace('<td><div><!--fk-17-01', "<div class='fk-todo'><td>Moms,<br>Tidsrapport<!--fk-17-01", $this->html);
			$this->html = str_replace('<td><div><!--fk-17-08', "<div class='fk-todo'><td>Moms,<br>Tidsrapport<!--fk-17-08", $this->html);
		}
		function add_moms_and_time_12(){
			$this->html = str_replace('<td><div><!--fk-12-02', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-02", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-03', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-03", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-04', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-04", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-05', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-05", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-06', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-06", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-07', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-07", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-09', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-09", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-10', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-10", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-11', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-11", $this->html);
			$this->html = str_replace('<td><div><!--fk-12-12', "<td><div class='fk-todo'>Moms,<br>Tidsrapport<!--fk-12-12", $this->html);
		}
		
		function add_declaration(){
			$this->fiscal_year_to_declaration();
			if ($this->declaration_day == $this->timeReport ) {
				$this->html = str_replace('<!--fk-' . $this->declaration_day . '-' . $this->declaration_month,',<br> Deklaration <!--', $this->html);
			}else{
				$this->html = str_replace('<td><div><!--fk-'.$this->declaration_day.'-'.$this->declaration_month,"<td><div class='fk-todo'>Deklaration <!--", $this->html);
			}	
		}
	
		function add_extra(){
			// get month with 0
			$extra_day = substr($this->extraDate, 8);
			//send in number month and get abr, i.e. 01 = '01'
			$extra_month = substr($this->extraDate, 5, 2);
			//if day is 12, 18, same as timereport, same as declaratuion, add without adding fk-todo class.
			//else add data and fk-todo class.
			if ($extra_day == 12 || $extra_day == 17 || $extra_day == $this->timeReport) {
				$this->html = str_replace('<!--fk-'.$extra_day.'-'.$extra_month, ',<br>' . $this->extra . "<!--".$extra_day.'-'.$extra_month , $this->html);
			}elseif ($extra_day == $this->declaration_day && $extra_month == $this->declaration_month) {
				$this->html = str_replace('<!--fk-'.$extra_day.'-'.$extra_month, ',<br>' . $this->extra . "<!--".$extra_day.'-'.$extra_month , $this->html);
			}
			else{
				$this->html = str_replace('<td><div><!--fk-'.$extra_day.'-'.$extra_month, "<div class='fk-todo'><td>". $this->extra . '<!--' , $this->html);
			}

		}
		function draw_calendar_month($month = null,$year = null){
		    date_default_timezone_set('Europe/Stockholm');
		    setlocale(LC_ALL, 'sv_SE');
		    // if no arg was passed set them to current month
		    if ($month == null) {
		    	$month = date('m');
		    }
		    if ($year == null) {
		    	$year = date('y');
		    }
		    // get header 
		    $calendar = file_get_contents('../views/pdf/pdf_month_header.html');
		    //write month
		    $calendar = str_replace('%month%', $this->num_to_letters_month($month), $calendar);
		    /* draw table */
		    $calendar .= '<table class="fk-table">';

		    /* table headings */
		    $headings = array('Vecka','Måndag','Tisdag','Onsdag','Torsdag','Fredag','Lördag','Söndag');
		    $calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';

		    /* days and weeks vars now ... */
		    //mkttime makes a timestamp in sec from 1970 1jan
		    //date(n) makes it to a number 0-7 representing mon-sun
		    // -1 makes it the last day in the month before.
		    $running_day = date('N',mktime(0,0,0,$month,1,$year))-1;
		    // number of days in current month
		    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		    // at least 1 day in first week
		    $days_in_this_week = 1;
		    $day_counter = 0;
		    $dates_array = array();

		    $week_number = date('W',mktime(0,0,0,$month,1,$year));


		    /* row for week one */
		    $calendar.= '<tr class="calendar-row">';

		    $calendar.= '<td><div class="fk-week">'.$week_number. '</div></td>';
		    /* print "blank" days until the first of the current week */
		    for($x = 0; $x < $running_day; $x++):
		        $calendar.= '<td><div class="fk-noday"> </div></td>';
		        $days_in_this_week++;
		    endfor;

		    /* keep going with days.... */
		    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		        $date = $list_day;
		        if (strlen($list_day) == 1) {
		            $date = '0'.$list_day;
		        }
		        $calendar.= '<td>';
		            //adds comment so pdf creator can change value.
		            $calendar.= '<div><!--fk-'.$date.'-'.$month.'-->';
		            /* add in the day number */
		            $calendar.= '<div class="fk-datenum">'.$list_day.'</div></div>';

		            
		        $calendar.= '</td>';
		        if($running_day == 6):
		            $calendar.= '</tr>';
		            if(($day_counter+1) != $days_in_month):
		                $calendar.= '<tr class="calendar-row">';
		                $week_number++;
		                if (strlen($week_number) == 1) {
		                    $week_number = '0'.$week_number;
		                }
		                $calendar.= '<td><div class="fk-week">'.$week_number. '</td></div>';
		            endif;
		            $running_day = -1;
		            $days_in_this_week = 0;
		        endif;
		        $days_in_this_week++; $running_day++; $day_counter++;
		    endfor;

		    /* finish the rest of the days in the week */
		    if($days_in_this_week < 8):
		        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
		            $calendar.= '<td><div class="fk-noday"></div> </td>';
		        endfor;
		    endif;

		    /* final row */
		    $calendar.= '</tr>';

		    /* end the table */
		    $calendar.= '</table>';
		        // get footer 
		    $calendar .= file_get_contents('../views/pdf/pdf_month_footer.html');
		    
		    /* Put the result in html file */
		    $this->html = $calendar;
		}
		function put_contents(){
			file_put_contents('../views/pdf/build/pdf'.$this->guid.'.html', $this->html);
		}


	}
?>