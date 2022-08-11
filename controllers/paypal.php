<?php

class Paypal extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->library('Paypal_Lib');
    }

	
	function index()
	{
		settype($response, "object");

		if(count($_GET)==0 || $_GET["a"] == null)
		{
			die("{}");
			return;
		}
		
		$action = $_GET["a"];

		if($action =="new")
		{
		  $response->pid = $_POST["pid"];
		  $response->item = $_POST["item"];
		  $response->price = $_POST["price"];
		  $response->buyername = $_POST["buyername"];
		  $response->email = $_POST["email"];
				//$this->form();
		
		$str = 'insert into tbl_payments (p_buyername, p_buyer_email, item_name , mc_gross, item_number) values (?,?,?,?,?)';
		$this->db->query($str, array($response->buyername, $response->email, $response->item, $response->price, $response->pid));
		
		if($this->db->affected_rows()==0)
		{
			die("{}");
			return;
		}
		
		$query = $this->db->query('SELECT LAST_INSERT_ID() as pay_id FROM tbl_payments');
						
        $ID ="";						
        if ($query->num_rows() > 0)
          $response->payid=trim($query->Row()->pay_id);
						  
		  echo json_encode($response);
		  return;
		}				
	}
	
	
	public function Get_Option($option_name, $Default)
	{
				$this->load->database();	
	   $query = $this->db->query('SELECT option_value FROM tbl_options where option_name = "'.$option_name.'" LIMIT 1');

        if ($query->num_rows() > 0)
          return trim($query->Row()->option_value);
        else
          return $Default;
	}
	
	function ipn()
	{
	    $to    = $this->Get_Option('admin_email', 'programmer.ice@gmail.com');    //  your email
		
		if ($this->paypal_lib->validate_ipn()) 
		{
			   
			try
			{
				
				$str = 'update tbl_payments set 
		                        mc_gross = ? , 
		                        payment_date=? , 
								first_name=? , 
								business=? , 
								address_country=?, 
								address_city=? , 
								payer_email=?, 
								txn_id=? , 
								last_name=? , 
								receiver_email=? , 
								f_completed=1 
								where pay_id = '.$_POST["item_number"];
								
  		        $query = $this->db->query($str, array(										
                                $_POST["mc_gross"], 
								$_POST["payment_date"], 
								$_POST["first_name"], 
								$_POST["business"], 
								$_POST["address_country"],
								$_POST["address_city"], 
								$_POST["payer_email"], 
								$_POST["txn_id"], 
								$_POST["last_name"],
								$_POST["receiver_email"]));                 
				 
				 $pay_id = $_POST["item_number"];
				 
				 
				 $this->data->Prepare_Payment($pay_id,0);
				 
				 $this->Send_Nitification($pay_id);
				 
			}
			catch (Exception $e)
			{
				$this->mylog($e->getMessage());
			}
			
						
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "<br/>";
			$body .= " Details:<br/>";
			foreach ($this->paypal_lib->ipn_data as $key=>$value)
				$body .= "<br/>$key: $value";	
			// load email lib and email results
			$this->load->library('email');
			$this->email->initialize(array('mailtype' => 'html')); 
			$this->email->to($to);
			$this->email->from($this->data->GetOptionValue("support_email",""));
			$this->email->subject('Payment received');
			$this->email->message($body);	
			
			if(!$this->email->send()) {
				$this->mylog("error sending email");
				$this->mylog($this->email->print_debugger());
			}
			else
			{
				$this->mylog("email sent to admin");
			}
			
			
		}
		else
		 $this->mylog("ipn not valid!");
		
	}
	
	function cancel()
	{
		$data['Message'] = 'your purchase cannot be completed.';
		
		$data['Title'] = "Cancel";	 
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
	
		$this->load->view('message',$data);
		$this->load->view('4_footer');
	}
	
	function success()
	{
	
		$data['Message'] = '
             Your purchase was successfull.<br/>
             You can login and start using AMES.
			 ';
		$data['Title'] = "Success";	 
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
	
		$this->load->view('message',$data);
		$this->load->view('4_footer');
		
	}
	
	public function mylog($logdata)
		{
			
			try
			{
			$path = str_replace('system/','',BASEPATH);
			$path = $path . 'application/logs/';
			
			 $fp=fopen($path . 'paypal_ipn.log','a');
		fwrite($fp, $logdata . "\n\n"); 

		fclose($fp);  // close file  

			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}
		
		
function Send_Nitification($pay_id)
{



 $query = $this->db->query('SELECT * FROM tbl_payments where pay_id = '.$pay_id);

 if ($query->num_rows() > 0)
 {     
	 $pkid = $query->Row()->item_number;
     $transactionID = $query->Row()->txn_id;
     $EmailAddress = $query->Row()->p_buyer_email;
	 
	 $row = $this->data->get_package_info($pkid);
 }
		  
  $EmailBody = $this->load_template();


  $replace = $row->packagename." - ".$row->packagedesc ." - " . $row->price ."$ .";
	 
  $EmailBody = str_replace('@item',$replace,$EmailBody);
   
  
  $this->load->library('email');
  $this->email->initialize(array('mailtype' => 'html')); 
			$this->email->to($EmailAddress);
			$this->email->from($this->data->GetOptionValue("support_email",""));
			$this->email->subject('AMES: payment received');
			$this->email->message($EmailBody);				
 
  if(!$this->email->send()) {
				$this->mylog("error sending email");
				$this->mylog($this->email->print_debugger());

  echo "Mailer Error";
} else {
  echo "Message sent!";
  $this->mylog("Email have been sent");
}




 }
	
	
	 function load_template()
		{
			try
			{  
			 $this->load->helper('url');
			 $result = file_get_contents( site_url('data/Email_Template.html'));
			 return $result;
			}
			catch (Exception $e)
			{
				echo $e;
			}
		}
	
}
?>