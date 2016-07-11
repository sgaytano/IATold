<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		if( $this->session->userdata('user_logged_in') == TRUE ) redirect('index.php/AttendanceSchedule');
	}

	public function index(){
		$headers = apache_request_headers();
	/*
	if (!isset($headers['Authorization'])){
	    header('HTTP/1.1 401 Unauthorized');
	    header('WWW-Authenticate: NTLM');
	    exit;
	}
 
	$auth = $headers['Authorization'];
 
	if (substr($auth,0,5) == 'NTLM ') {
    	$msg = base64_decode(substr($auth, 5));
    	if (substr($msg, 0, 8) != "NTLMSSP\x00")
        die('error header not recognised');
 
    if ($msg[8] == "\x01") {
        $msg2 = "NTLMSSP\x00\x02\x00\x00\x00".
            "\x00\x00\x00\x00". // target name len/alloc
            "\x00\x00\x00\x00". // target name offset
            "\x01\x02\x81\x00". // flags
            "\x00\x00\x00\x00\x00\x00\x00\x00". // challenge
            "\x00\x00\x00\x00\x00\x00\x00\x00". // context
            "\x00\x00\x00\x00\x00\x00\x00\x00"; // target info len/alloc/offset
 
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: NTLM '.trim(base64_encode($msg2)));
        exit;
    }
    else if ($msg[8] == "\x03") {
        function get_msg_str($msg, $start, $unicode = true) {
            $len = (ord($msg[$start+1]) * 256) + ord($msg[$start]);
            $off = (ord($msg[$start+5]) * 256) + ord($msg[$start+4]);
            if ($unicode)
                return str_replace("\0", '', substr($msg, $off, $len));
            else
                return substr($msg, $off, $len);
        }
        $user = get_msg_str($msg, 36);
        $domain = get_msg_str($msg, 28);
        $workstation = get_msg_str($msg, 44);
 
        print "You are $user from $domain/$workstation";
    	}
	}		
		
		echo $user;
		exit;
		$user_pc_name=$user;
		$user_ln_result = $this->db->query("SELECT * FROM users WHERE ln_id='$user_pc_name'")->result();
		if(count($user_ln_result)){
			$this->session->set_userdata (
					array(
							'username' => $user_ln_result[0]->username,
							'fullname' => $user_ln_result[0]->fullname,
							'level' => $user_ln_result[0]->level,
							'pw' => $user_ln_result[0]->password,
							'saved' => false,
							'generated' => false,
							'user_logged_in' => TRUE,
							'workweek'=>date("W")
					)
			);
			redirect("index.php/AttendanceSchedule");
		}
		*/
		$data['main_content'] = "";
		$data['login_error'] = "";	
		$this->load->view('LoginView',$data);		
	}
	
	public function processLogin() {
		
		$username = $this->input->post("username");
		$password = md5($this->input->post("password"));
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
				
	
		echo date("W");
		//exit;
		
		if ($this->form_validation->run() == FALSE)
		{
			
				$data['login_error'] = "";
				$this->load->view('LoginView',$data);
		}
		else
		{
		
			$login_query = "SELECT username,fullname,level FROM users WHERE username='".$username."' AND password='".$password."'";
			$login_result = $this->db->query($login_query)->result();
			
			if(count($login_result)){
				$this->session->set_userdata (
						array(
								'username' => $login_result[0]->username,
								'fullname' => $login_result[0]->fullname,
								'level' => $login_result[0]->level,
								'pw' => $password,
								'saved' => false,
								'generated' => false,
								'user_logged_in' => TRUE,
								'workweek'=>date("W")
						)
				);
				
				redirect("index.php/AttendanceSchedule");
			} else {
				$data['login_error'] = "invalid password";
				$this->load->view('LoginView',$data);
			}
		
		}
		
		
	}
	
}
