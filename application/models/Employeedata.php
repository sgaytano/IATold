<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeData extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	public function getEmployees(){ 

		$list_of_employees = array(
			"Dio, Loudes Alicia",
			"Flores, Charmagne",
			"Macospag, Elaine",
			"Pailden, Merven",
			"Reyes, Ma. Bernadette",
			"Ardaniel, Jefrie",
			"Manliclic, Stephen Kyler",
			"Camba, James Anne",
			"Basada, Ma. Angelica",
			"Mandi, Jean",
			"Gaytano, Sherwin"
		);

		return $list_of_employees;
	}
	
	public function getDays() {
		
		return array(
				"Monday",
				"Tuesday",
				"Wednesday",
				"Thursday",
				"Friday",
				"Saturday",
				"Sunday"
		);
	}
	
	public function getLocation() {
		
		return array(
				"Office",
				"Home",
				"OB",
				"SIL",
				"Holidays"
		);
	}
	
	public function getWorkWeek() {
		
		return array(
				'Week 30' =>"7/20/2015 to 7/26/2015",
				'Week 31' =>"7/27/2015 to 8/2/2015",
				'Week 32' =>"7/20/2015 to 7/26/2015",
				'Week 33' =>"7/20/2015 to 7/26/2015",
				'Week 34' =>"7/20/2015 to 7/26/2015",
				'Week 35' =>"7/20/2015 to 7/26/2015",
				'Week 36' =>"7/20/2015 to 7/26/2015",
				'Week 37' =>"7/20/2015 to 7/26/2015",
				'Week 38' =>"7/20/2015 to 7/26/2015",
				'Week 39' =>"7/20/2015 to 7/26/2015",
				'Week 40' =>"7/20/2015 to 7/26/2015",
				'Week 41' =>"7/20/2015 to 7/26/2015",
				'Week 42' =>"7/20/2015 to 7/26/2015",
				'Week 43' =>"7/20/2015 to 7/26/2015",
				'Week 44' =>"7/20/2015 to 7/26/2015",
				'Week 45' =>"7/20/2015 to 7/26/2015",
				'Week 46' =>"7/20/2015 to 7/26/2015",
				'Week 47' =>"7/20/2015 to 7/26/2015",
				'Week 48' =>"7/20/2015 to 7/26/2015",
				'Week 49' =>"7/20/2015 to 7/26/2015",
				'Week 50' =>"7/20/2015 to 7/26/2015",
				'Week 51' =>"7/20/2015 to 7/26/2015",
				'Week 52' =>"7/20/2015 to 7/26/2015",
				'Week 53' =>"7/20/2015 to 7/26/2015",
		); 
	
	}
	
	public function getTimeMap() {
		
		return array(
			"00:00"=>"12am",
			"01:00"=>"1am",
			"02:00"=>"2am",
			"03:00"=>"3am",
			"04:00"=>"4am",
			"05:00"=>"5am",
			"06:00"=>"6am",
			"07:00"=>"7am",
			"08:00"=>"8am",
			"09:00"=>"9am",
			"10:00"=>"10am",
			"11:00"=>"11am",
			"12:00"=>"12pm",
			"13:00"=>"1pm",
			"14:00"=>"2pm",
			"15:00"=>"3pm",
			"16:00"=>"4pm",
			"17:00"=>"5pm",
			"18:00"=>"6pm",
			"19:00"=>"7pm",
			"20:00"=>"8pm",
			"21:00"=>"9pm",
			"22:00"=>"10pm",
			"23:00"=>"11pm",
			"00:00_"=>"12am2",
			"01:00_"=>"1am2",
			"02:00_"=>"2am2",
			"03:00_"=>"3am2",
			"04:00_"=>"4am2",
			"05:00_"=>"5am2",
			"06:00_"=>"6am2",
			"07:00_"=>"7am2"
		);
		
	}
	
	public function getTimeMapByStartTime() {
	
		return array(
				"00:00"=>"12:00 AM",
				"01:00"=>"1:00 AM",
				"02:00"=>"2:00 AM",
				"03:00"=>"3:00 AM",
				"04:00"=>"4:00 AM",
				"05:00"=>"5:00 AM",
				"06:00"=>"6:00 AM",
				"07:00"=>"7:00 AM",
				"08:00"=>"8:00 AM",
				"09:00"=>"9:00 AM",
				"10:00"=>"10:00 AM",
				"11:00"=>"11:00 AM",
				"12:00"=>"12:00 PM",
				"13:00"=>"1:00 PM",
				"14:00"=>"2:00 PM",
				"15:00"=>"3:00 PM",
				"16:00"=>"4:00 PM",
				"17:00"=>"5:00 PM",
				"18:00"=>"6:00 PM",
				"19:00"=>"7:00 PM",
				"20:00"=>"8:00 PM",
				"21:00"=>"9:00 PM",
				"22:00"=>"10:00 PM",
				"23:00"=>"11:00 PM"
		);
	
	}	
	
}