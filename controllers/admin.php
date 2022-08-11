<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Ice_Controller {

    public $Headers = '<script type="text/javascript" src="js/tab.js"></script>
	<script type="text/javascript" src="js/admin.js"></script>	
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>';
	
	public function index()
	{
		
		$data["txtPaypal"]=$this->data->GetOptionValue('paypal_email','');
		$data["txtadmin"]=$this->data->GetOptionValue('admin_email','');
		$data["txtsupport"]=$this->data->GetOptionValue('support_email','');
		
		$data["currentpass"]=$this->data->getUserInfoRow($this->session->userdata('uid'))->password;
				 
						 
		$this->load->view('0_page_start');
		$this->load->view('1_menu_admin');
	
		$this->load->view('admin', $data);
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */