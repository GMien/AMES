<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ice_Controller extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('uid')=="")
		  redirect('/login?redirect='.current_url(), 'refresh');
		  


	}
	
	
	
}

?>