<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceSchedule extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		if ($this->session->userdata ( 'user_logged_in' ) != TRUE) { redirect ( 'index.php/LoginController' ); }
	}

	public function index()
	{	
		$this->AddSchedule($this->input->post("saved"),$this->input->post("generated"));
	}
	
	public function redirectWorkWeek() {
		$this->session->set_userdata('workweek',$this->uri->segment(3));	
		redirect("index.php/AttendanceSchedule");
	}
	
	public function AddSchedule($saved=false,$generated=false){
		//echo date("W");
		//echo date("m/d",strtotime('monday this week'));
		//exit;
		if($this->session->userdata("saved")==true){
			$saved = true;
			$this->session->set_userdata("saved",false);
		} elseif ($this->session->userdata("generated")==true){
			$generated = true;
			$this->session->set_userdata("generated",false);
		}
		
		$employee_query = $this->db->query("SELECT fullname FROM users WHERE level=0 OR level=1 ORDER BY fullname")->result();
		$employee_data = array();
		foreach ($employee_query as $employee_row) {
			array_push($employee_data, $employee_row->fullname);
		}
		
		//$work_week_date = $this->session->userdata("workweek");
		$work_week_date = date("W");
		$employee_container = array();
		$employee_iteration=0;
		foreach($employee_data as $employee) {
			
			$days_avail = [];
			$employee_result = $this->db->query("SELECT location,day,starttime,endtime FROM attendanceschedule WHERE name='$employee' AND workweek='$work_week_date'")->result();
			
			foreach ($employee_result as $days_result) {
				
				if($days_result->starttime !='' || $days_result->endtime !=''){
					if($days_result->location == "SIL") {
						$days_avail[$days_result->day]="SIL";
					}else{
						$days_avail[$days_result->day]="OK";
					}
				}
				//array_push($days_avail, $days_result->day);
			}
			
			$employee_container[$employee] = $days_avail;
			$employee_iteration++;
		}
		
		$data['access_level'] = $this->session->userdata('level');
		$data['current_user_fullname'] = $this->session->userdata('fullname');
		$data['employee_data'] = $employee_data;
		$data['employee_work_days'] = $employee_container;
		
		$data['days'] = $this->employeedata->getDays();
		$data['locations'] = $this->employeedata->getLocation();
		$data['timemap'] = $this->employeedata->getTimeMapByStartTime();
		$data['work_week_num'] = $work_week_date; 
		$data['schedule_saved'] = $saved;
		$data['schedule_generated'] = $generated;
		
		if(date("W") !=$work_week_date){
		
		$data['week_dates'] = array(
				date("m/d/y",strtotime('monday next week')),
				date("m/d/y",strtotime('tuesday next week')),
				date("m/d/y",strtotime('wednesday next week')),
				date("m/d/y",strtotime('thursday next week')),
				date("m/d/y",strtotime('friday next week')),
				date("m/d/y",strtotime('saturday next week')),
				date("m/d/y",strtotime('sunday next week'))
		);
		
		}else{
			$data['week_dates'] = array(
					date("m/d/y",strtotime('monday this week')),
					date("m/d/y",strtotime('tuesday this week')),
					date("m/d/y",strtotime('wednesday this week')),
					date("m/d/y",strtotime('thursday this week')),
					date("m/d/y",strtotime('friday this week')),
					date("m/d/y",strtotime('saturday this week')),
					date("m/d/y",strtotime('sunday this week'))
			);			
		}

		$nextworkweek = date("W");
		//$nextworkweek += 1;
		//echo $nextworkweek;
		//exit;
		if(substr($nextworkweek,0,1)==0){
			$nextworkweek += 1;
			$nextworkweek = "0".$nextworkweek;
		}else{
			$nextworkweek += 1;
		}
		//echo substr($nextworkweek,0,1);
		//echo $nextworkweek;

		//exit;
		$data['work_week'] = array(
				date("W")=>date("W").", ".date("m/d",strtotime('monday this week'))." to ".date("m/d",strtotime('sunday this week'))
				//$nextworkweek=>$nextworkweek.", ".date("m/d",strtotime('monday next week'))." to ".date("m/d",strtotime('sunday next week'))
		);
		
		//print_r($data['work_week']);
		//exit;	
		$data['main_content'] = "pages/AddScheduleView";
		$this->load->view('MainView',$data);
		
	}
	
	public function GenerateSchedule()
	{
		$employee_query = $this->db->query("SELECT fullname FROM users WHERE level=0 OR level=1")->result();
		$employee_data = array();
		foreach ($employee_query as $employee_row) {
			array_push($employee_data, $employee_row->fullname);
		}
		
		$data['employee_data'] = $employee_data;
		$data['days'] = $this->employeedata->getDays();
		$data['locations'] = $this->employeedata->getLocation();
		$data['work_week'] = date("W").", ".date("m/d",strtotime('monday this week'))." to ".date("m/d",strtotime('sunday this week'));
		$data['main_content'] = "pages/GenerateScheduleView";
		$this->load->view('MainView',$data);
	}
	
	
	public function ProcessGenerateSchedule() {
		
		require 'application/third_party/PHPMailerAutoload.php';
		
		$this->session->userdata('workweek');
		
		
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = EMAIL_USER;
		$mail->Password = EMAIL_PASS;
		//$mail->SMTPDebug = 2;
		//$mail->Debugoutput = "html";
		$mail->setFrom('innovationteamportal@gmail.com', 'Innovative Team');
		
		$mail->addAddress('jefrie.ardaniel@convergys.com', 'Jefrie Ardaniel');
		$mail->addAddress('sherwin.gaytano@convergys.com', 'Sherwin Gaytano');
		$mail->addAddress('artheo.rivera@convergys.com', 'Artheo Rivera');
		$mail->addAddress('charmagne.aguas@convergys.com', 'Charmagne Aguas');
		$mail->addAddress('jean.mandi@convergys.com', 'Jean Madi');
		$mail->addAddress('kerby.de.jesus@convergys.com', 'Kerby De Jesus');
		$mail->addAddress('kharen.joy.fabe@convergys.com', 'Kharen Joy Febe');
		//$mail->addAddress('merven.pailden@convergys.com', 'Merven Pailden');
		$mail->addAddress('michael.cagampan@convergys.com', 'Michael Cagampan');
		$mail->addAddress('lourdesalicia.dio@convergys.com', 'Lourdes Alicia Dio');
		$mail->addAddress('alan.barona@convergys.com', 'Alan Abad Barona');
		
		$mail->Subject = 'Weekly Schedule Report';
		
		$timemap = $this->employeedata->getTimeMap();
		$data['timemap'] = $timemap;
		
		if($this->session->userdata('workweek')==date("W")){
		
			$data['week_monday'] = date("d M",strtotime('monday this week'));
			$data['datasource_raw']=$this->db->query("SELECT * FROM attendanceschedule WHERE workweek='".date("W")."' ORDER BY date_stamp ASC, name")->result();
			$count_result=$this->db->query("SELECT COUNT(DISTINCT name) as countPerName FROM attendanceschedule WHERE workweek='".date("W")."' ORDER BY date_stamp DESC, name")->result();
		
		}else{
			
			$data['week_monday'] = date("d M",strtotime('monday next week'));
			$data['datasource_raw']=$this->db->query("SELECT * FROM attendanceschedule WHERE workweek='".$this->session->userdata('workweek')."' ORDER BY date_stamp ASC, name")->result();
			$count_result=$this->db->query("SELECT COUNT(DISTINCT name) as countPerName FROM attendanceschedule WHERE workweek='".$this->session->userdata('workweek')."' ORDER BY date_stamp DESC, name")->result();			
		}
		
		$data['count_per_date'] = $count_result[0]->countPerName;
		
		$dataContainer = array();
		$interate=0;
		foreach ($data['datasource_raw'] as $datapointer){
			
			$timeIterate=0;
			$startIndex=0;
			$endIndex=0;
			foreach ($timemap as $key=>$value) {
				if($datapointer->starttime == $key){
					$startIndex = $timeIterate;
				}
				if($datapointer->endtime == $key){
					$endIndex = $timeIterate;
				}
				$timeIterate++;
			}
			
			$dataContainer[$interate] = (object)array("id"=>$datapointer->id,
					"name"=>$datapointer->name,
					"location"=>$datapointer->location,
					"starttime"=>$datapointer->starttime,
					"endtime"=>$datapointer->endtime,
					"totalhours"=>$datapointer->totalhours,
					"date_stamp"=>$datapointer->date_stamp,
					"time_range"=>array_slice($timemap,$startIndex,10)
			);
			//print_r($dataContainer[$interate]->time_range);
			//exit;
			$interate++;
		}
		
		$data['datasource'] = $dataContainer;
		$message = $this->load->view('email_template/schedule2',$data,TRUE);
		$mail->msgHTML($message);
			
		if (!$mail->send()) {
			
		} else {
			
			$this->session->set_userdata("generated",true);
			redirect("index.php/AttendanceSchedule");
			//$this->AddSchedule(false,true);
		}
		
		
	}
	
	public function ProcessAddSchedule(){
		
		$days = $this->employeedata->getDays();
		//$num_days = 0;
		$work_week_date = $this->input->post('work_week');
		$employee = $this->input->post('employee_list');
		$employee_result = $this->db->query("SELECT id FROM attendanceschedule WHERE name='$employee' AND workweek='$work_week_date'")->result();
		//echo count($employee_result);
		if(count($employee_result) >= 1) {
			
			//delete all entries
			$this->db->query("DELETE FROM attendanceschedule WHERE name='$employee' AND workweek='$work_week_date'");
			
			$num_days = 0;
			// Add new schedule
			foreach ($days as $day) {
					
				if($this->input->post("end_time_nextday$num_days")=="1"){
					$next_day = $this->input->post("end_time_db$num_days")."_";
				} else {
					$next_day = $this->input->post("end_time_db$num_days");
				}
					
				$insert_schedule = array(
						"name"=>$this->input->post('employee_list'),
						"workweek"=>$this->input->post('work_week'),
						"location"=>$this->input->post("location_choices$num_days"),
						"starttime"=>$this->input->post("start_time$num_days"),
						"endtime"=>$next_day,
						"day"=>$days[$num_days],
						"date_stamp"=>$this->input->post("weekdates$num_days"),
						"totalhours"=>'9'
				);
					
				$this->db->insert("attendanceschedule",$insert_schedule);
					
				$num_days++;
			}			
					
			
		}else{

			$num_days = 0;
			// Add new schedule
			foreach ($days as $day) {
			
				if($this->input->post("end_time_nextday$num_days")=="1"){
					$next_day = $this->input->post("end_time_db$num_days")."_";
				} else {
					$next_day = $this->input->post("end_time_db$num_days");
				}
					
				$insert_schedule = array(
						"name"=>$this->input->post('employee_list'),
						"workweek"=>$this->input->post('work_week'),
						"location"=>$this->input->post("location_choices$num_days"),
						"starttime"=>$this->input->post("start_time$num_days"),
						"endtime"=>$next_day,
						"day"=>$days[$num_days],
						"date_stamp"=>$this->input->post("weekdates$num_days"),
						"totalhours"=>'9'
				);
					
				$this->db->insert("attendanceschedule",$insert_schedule);
					
				$num_days++;
			}			
		}
		//exit;
		
		//$this->AddSchedule(true,false);
		$this->session->set_userdata("saved",true);
		redirect("index.php/AttendanceSchedule");
		
	}
	
	public function logout(){
		
		$this->session->sess_destroy();
		redirect ( 'index.php/LoginController' );
		
	}
	
	public function getUserSchedule(){
		$data = $this->db->query("SELECT location,starttime,endtime FROM attendanceschedule WHERE workweek='".$this->input->post("workweek")."' AND name='".$this->input->post("name")."'")->result();
		echo json_encode($data);
		
	}
	
	
}

?>
