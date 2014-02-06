<?php 
/**
* Ical creator
*/
require_once 'class.ical.php';

class Ical_creator extends Base_Model{
	public $name, $momsperiod, $financialtime;
	public $timeReport, $extra, $extraDate;
	public $declaration_day, $declaration_month;
	public $moms_payment_year;
	public $ical;
	
	function __construct(array $attributes){
		parent::__construct($attributes);
		$this->ical = new iCal();
	}
	function add_timereport(){
		
		for ($i=1; $i <13 ; $i++) {
			$month = $i;
			if (strlen($i) == 1) {
				$month = "0".$i;
			}
			$this->ical->NewEvent();
			$this->ical->SetTitle('Tidrapport');
			$this->ical->SetDescription('Dags att lämna in Tidrapport');
			$this->ical->SetDates('2014-'. $month .'-'. $this->timeReport . ' 20:15', '2014-'. $month .'-' . $this->timeReport .  ' 22:15');

			$this->ical->SetAlarm();
			$this->ical->SetAlarmText('Dags att lämna in Tidrapport');
			$this->ical->SetAlarmTrigger(30); //minutes before event		
		}
	}
	function add_declaration(){
		$this->fiscal_year_to_declaration();
		$month = $this->date_convertion_to_number($this->declaration_month);
		$this->ical->NewEvent();
		$this->ical->SetTitle('Deklaration');
		$this->ical->SetDescription('Sista dagen att lämna in deklaration');
		$this->ical->SetDates('2014-'. $month .'-'. $this->declaration_day . ' 12:00', '2014-'. $month .'-' . $this->declaration_day .  ' 23:59');

		$this->ical->SetAlarm();
		$this->ical->SetAlarmText('Dags att lämna in Deklaration');
		$this->ical->SetAlarmTrigger(30); //minutes before event

	}
	function add_momsperiod_month(){
		for ($i=1; $i <13 ; $i++) {
			$month = $i;
			if (strlen($i) == 1) {
				$month = '0'.$i;
			}
			$date = 0;
			 if ($month == 01 || $month == 08) {
			 	$date = '17';
			 }else{
			 	$date = '12';
			 }
			$this->ical->NewEvent();
			$this->ical->SetTitle('Moms');
			$this->ical->SetDescription('Dags att lämna in Moms');
			$this->ical->SetDates('2014-'. $month .'-'. $date . ' 20:15', '2014-'. $month .'-' . $date .  ' 22:15');

			$this->ical->SetAlarm();
			$this->ical->SetAlarmText('Dags att lämna in Moms');
			$this->ical->SetAlarmTrigger(30);		
		}
	}
	function add_momsperiod_quarter(){
		for ($i=0; $i < 4 ; $i++) { 
			$this->ical->NewEvent();
			$this->ical->SetTitle('Moms');
			$this->ical->SetDescription('Dags att lämna in Moms');
			switch ($i) {
				case '0':
					$this->ical->SetDates('2014-02-12 20:15', '2014-02-12 20:15');
					break;
				case '1':
					$this->ical->SetDates('2014-05-12 20:15', '2014-02-12 20:15');
					break;
				case '2':
					$this->ical->SetDates('2014-08-18 20:15', '2014-02-12 20:15');
					break;
				case '3':
					$this->ical->SetDates('2014-11-12 20:15', '2014-02-12 20:15');
					break;
			}	
			
			$this->ical->SetAlarm();
			$this->ical->SetAlarmText('Dags att lämna in Moms');
			$this->ical->SetAlarmTrigger(30);
		}
	}
	function add_momsperiod_year(){
		$this->set_moms_year();
		$day = substr($this->moms_payment_year, 0, 2);
		$month_as_letters = substr($this->moms_payment_year, 3);
		// get month and convert it to numbers
		$month = $this->date_convertion_to_number($month_as_letters);

		$this->ical->NewEvent();
		$this->ical->SetTitle('Moms');
		$this->ical->SetDescription('Dags att lämna in Moms');
		$this->ical->SetDates('2014-'. $month .'-'. $day . ' 12:00', '2014-'. $month .'-' . $day .  ' 23:59');

		$this->ical->SetAlarm();
		$this->ical->SetAlarmText('Dags att lämna in Moms');
		$this->ical->SetAlarmTrigger(30); //minutes before event
	}
	function add_extra(){
		$this->ical->NewEvent();
		$this->ical->SetTitle($this->extra);
		$this->ical->SetDescription($this->extra);
		$this->ical->SetDates($this->extraDate . ' 12:00', '2014-'. $this->extraDate . ' 23:59');

		$this->ical->SetAlarm();
		$this->ical->SetAlarmText($this->extra);
		$this->ical->SetAlarmTrigger(30); //minutes before event
	}
	
	function create_ical(){
		$this->ical->Write('../views/ical.ics');
	}
}



 ?>