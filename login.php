<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public $Headers = '<script type="text/javascript" src="js/login.js"></script>';
	public function index()
	{
		

		
		if($this->input->get("act")=="logout")
		{
			$this->session->sess_destroy();
			redirect(site_url(''), 'refresh');
			return;
		}
		
		$user = $this->input->post("txtuser");
		$pass = $this->input->post("txtpass");
		
		$data["txtuser"]=$this->input->post("txtuser");
		$data["txtpass"]=$this->input->post("txtpass");
		$data["message"] = "";
		$data["hide"] = "hide";
		if($user != "" && $pass !="")
		{			
			$row = $this->data->LoginUser($user, $pass);
			if(count($row)>0)
			{
				$session = array('username'  => $row->username,
                         'email'     => $row->user_email,
                         'logged_in' => TRUE,
						 'uid'=>$row->uid,
						 'parentid'=>$row->parent,
						 'usertype'=>$row->usertype,
						 'userbusiness'=> $row->user_business,
						 'user_access'=>$row->user_access,
						 'user_percent'=>10);
				
				if($row->usertype == 0)
				{
					$row = $this->data->getParent_User($row->parent);
					$session["userbusiness"] = $row->user_business;
				}
		        $this->session->set_userdata($session);
				$redirect = $this->input->get('redirect');
				if( trim($redirect)!='')
				  redirect(trim($redirect), 'refresh');
				else
				  redirect(site_url(''), 'refresh');
				return;
			}
			else
			{
				$row = $this->data->LoginUserPayment($user, $pass);
				if(count($row)>0)
			    {
				 $data["hide"]="";
				 $data["message"] = "Your payment hasent been approved.";
				}
				else
				{
				  $data["hide"]="";
				  $data["message"] = "Username or password is wrong!";
				}
			}
		}
		
		if($this->session->userdata('uid')!="")
		{
			redirect(site_url(''), 'refresh');
			return;
		}
		$this->load->view('0_page_start');
		$this->load->view('1_menu_normal');
	
		$this->load->view('login',$data);
		$this->load->view('4_footer');
		
		
		
		/*
		
		
				
		$session = array('username'  => 'Admin',
                         'email'     => 'Admin@google.com',
                         'logged_in' => TRUE,
						 'uid'=>2,
						 'parentid'=>2,
						 'usertype'=>1,
						 'user_percent'=>10);
						 
		$this->session->set_userdata($session);
		*/
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */