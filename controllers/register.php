<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public $Headers = '<script type="text/javascript" src="js/register.js"></script>';
	public function index()
	{
		if($this->session->userdata('uid')!="")
		{
			redirect(site_url(''), 'refresh');
			return;
		}
		$this->load->view('0_page_start');
		$this->load->view('1_menu_normal');
		$this->load->view('register');
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */