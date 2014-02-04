<?php 
/**
* Ical creator
*/
require_once 'class.ical.php';

class Ical_creator{
	public $ical;
	
	function __construct(){
		$this->ical = new iCal();
	}
	function timereport($day){
		if (strlen($day) == 1) {
			$day = "0".$day;
		}
		for ($i=1; $i <13 ; $i++) {
			$month = $i;
			if (strlen($i) == 1) {
				$month = "0".$i;
			}
			$this->ical->NewEvent();
			$this->ical->SetTitle("Tidrapport");
			$this->ical->SetDescription("Dags att lämna in Tidrapport");
			$this->ical->SetDates("2014-". $month ."-". $day . " 20:15", "2014-". $month ."-" . $day .  " 22:15");
			$this->ical->SetStatus("confirmed");
			$this->ical->SetLocation("place to go");

			$this->ical->SetAlarm();
			$this->ical->SetAlarmText("Dags att lämna in Tidrapport");
			$this->ical->SetAlarmTrigger(30); //minutes before event		
		}

	}
	function create_ical(){
		$this->ical->Write('../views/ical.ics');
	}
}



 ?>