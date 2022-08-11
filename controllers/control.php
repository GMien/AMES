<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends Ice_Controller {

    public $Headers = '
	<script type="text/javascript" src="js/control.js"></script>	
';
	
	public function index()
	{
		
		
		 
						 
		$this->load->view('0_page_start');
		$this->load->view('1_menu_login');
	
		$this->load->view('control');
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */