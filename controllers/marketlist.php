<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketlist extends Ice_Controller {

    public $Headers = '
	<link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
	<script type="text/javascript" src="js/jquery.fineuploader-3.4.1.js"></script>
	<script type="text/javascript" src="js/markets.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>	
	';
	
	public function index()
	{
		
				 
						 
		$this->load->view('0_page_start');
		$this->load->view('1_menu_login');
	
		$this->load->view('markets');
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */