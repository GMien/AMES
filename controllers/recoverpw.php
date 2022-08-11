<?php
class Recoverpw extends CI_Controller{

	public function  __construct(){
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
	}
	
	public function index(){
		$email = $this->input->post('email'); 
		$this->forgotPassword($email);
	}	

	public function forgotPassword($email){
			if($query = $this->data->check_email($email)){
				echo "true";
				$this->sendPassword($query); 
			}else{
				return 0;
			}
	}

		public function sendPassword($query){
		
		    foreach($query as $val){
				$username = $val->username;
				$email = $val->user_email;
				$password = $val->password;
			}	

			$to      = 	$email;
			$subject = 'AMES Automated Menu Engineering Password Recovery';
			$message = "";
			$message .= "Username: ".$username." \n";
			$message .= "Password: ".$password." \n";

			$headers = 'From: '.$email . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers)){
				return true;
			}else{
				return false;

			}
		}	
	
}

