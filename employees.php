<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends Ice_Controller {

    public $Headers = '<script type="text/javascript" src="js/tab.js"></script>
	<script type="text/javascript" src="js/employees.js"></script>	
		<link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>';
	
	public function index()
	{
		
			 
						 
		$this->load->view('0_page_start');
		$this->load->view('1_menu_login');
	
	
	    $userinfo = $this->data->userinfo($this->session->userdata('uid'),$this->session->userdata('parentid'))->row();
		
	    $data->currentpass = $userinfo->password;
		$data->user = $userinfo->username;
		$data->role=$userinfo->role;
		$data->business=$userinfo->user_business;
		$data->onlyadmin = "display:none;";
		if($userinfo->usertype >0)
		  $data->onlyadmin = "";
		
		$this->load->view('employees',$data );
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */