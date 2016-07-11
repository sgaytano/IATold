<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class myaccount extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
	}

	public function index(){

		$data['save_msg'] = "";
		$data['access_level'] = $this->session->userdata('level');
		$data['current_user_fullname'] = $this->session->userdata('fullname');
		$data['main_content'] = "pages/myaccount";
		$this->load->view('MainView',$data);		
	}
	
	public function changepassword(){
		
		$this->form_validation->set_rules('ncpassword', 'Password', 'required');
		$this->form_validation->set_rules('npassword', 'Password Confirmation', 'required|matches[ncpassword]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['access_level'] = $this->session->userdata('level');
			$data['current_user_fullname'] = $this->session->userdata('fullname');			
			$data['save_msg'] = "";
			$data['main_content'] = "pages/myaccount";			
			$this->load->view('MainView',$data);
		} else {
			$username = $this->session->userdata("username");
			$result_save = $this->db->query("UPDATE users SET password='".md5($this->input->post('npassword'))."' WHERE username='".$username."'");
			if($result_save){
				$data['access_level'] = $this->session->userdata('level');
				$data['current_user_fullname'] = $this->session->userdata('fullname');				
				$data['save_msg'] = "Change Password Success!";
				$data['main_content'] = "pages/myaccount";
				$this->load->view('MainView',$data);
			}
		}
		
	}
	
	
}