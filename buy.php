<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buy extends CI_Controller {

    public $Headers = '<script type="text/javascript" src="js/buy.js"></script>';
	public function index()
	{
		if($this->session->userdata('uid')=="")
		{
			redirect(site_url(''), 'refresh');
			return;
		}
		
		if($this->input->get('pkid')=='')
		{
			redirect(site_url(''), 'pricing');
			return;
		}
		
		$pkid = $this->input->get('pkid');
		$parentid = $this->session->userdata('parentid');
		
		$data = $this->data->buyPackage($pkid, $parentid);
	
		if(!$data || !$data["success"])
		{
			redirect(site_url(''), 'pricing');
			return;
		}
		
		
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
		$this->load->view('buy',$data);
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */