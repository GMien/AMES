<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	  public $Headers = '

	<link rel="stylesheet" href="css/themes/default/default.css" type="text/css" />
	<script type="text/javascript" src="js/carousel.js"></script>
	<script type="text/javascript" src="js/transition.js"></script>
	
<script type="text/javascript" src="js/main.js"></script>
	';
	public function index()
	{ 
		  
		  
		//$this->load->view("welcome_message.php");
				$this->load->view('0_page_start');
				
				
		$userType = $this->session->userdata('usertype');
		if($userType=="")		
		$this->load->view('1_menu_normal');
		else if($userType=="2")
		{
		  redirect(site_url('admin'), 'refresh');
		  return;
		}
		else
		$this->load->view('1_menu_login.php');


        if($userType=="")
		$this->load->view('main_normal');
		  else
		$this->load->view('main');
		
		
		
		$this->load->view('4_footer');
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */