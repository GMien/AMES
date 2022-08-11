<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends CI_Controller {

    public $Headers = '<script type="text/javascript" src="js/tab.js"></script>
	
		<link rel="stylesheet" type="text/css" href="css/pricing.css"/>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>';
	
	public function index()
	{
		$loggedin = $this->session->userdata('uid')!="";
		$data = $responce = (object) array();
		$data->Packages = array();
		$query = $this->data->getpackages();
		$i=0;
		foreach ($query->result() as $row)
        {		
				
			$data->Packages[$i]->pkid=$row->pkid;
			$data->Packages[$i]->packagename=$row->packagename;
			$data->Packages[$i]->info1=$row->info1;
			$data->Packages[$i]->info2=$row->info2;
			$data->Packages[$i]->info3=$row->info3;
			$data->Packages[$i]->info4=$row->info4;
			$data->Packages[$i]->packagedesc=$row->packagedesc;
			$data->Packages[$i]->price=$row->price;
			if(!$loggedin)
			  $data->Packages[$i]->link=site_url(('register?pkid='.$row->pkid));
			else
			  $data->Packages[$i]->link=site_url(('buy?pkid='.$row->pkid));
			$i++;

        }
						 
		if($this->session->userdata('uid')=="")
		  $data->ButtonCaption ="Sign Up";
		else
  		  $data->ButtonCaption ="Buy";
						 
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
	
		$this->load->view('pricing', $data);
		$this->load->view('4_footer');
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */