<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
	
	}

	public function index()
	{
		//This will load the registration view
		//$this->load->view('register');	
	}

	

	public function get_registration_data()
	{
		
		$email=$this->input->post('email');
		// for password validation
		$pass=$this->input->post('password');
		$confpass=$this->input->post('password_confirm');


		$result=$this->register_model->verfiy_email($email);
		if($result==TRUE)
		{
			$this->session->set_flashdata('message', 'Email is already registered!!');	
			redirect(base_url().'index.php/home/register','refresh');
		}
		elseif($pass!=$confpass) {
			$this->session->set_flashdata('message', 'Passwords & Confirm password doesnot match!!!');
			redirect(base_url().'index.php/home/register','refresh');
		}
		else
		{
			$dob=$this->input->post('dob');
			$dob = strtotime($dob);
			$user_id = uniqid();
			$data = array(
			'user_id'=>$user_id,	
			'email'   => $email,
			'first_name'   => $this->input->post('first_name'),
			'last_name'   => $this->input->post('last_name'),
			'dob'   => $dob,
			'email'      => $this->input->post('email'),
			'password'   => md5($this->input->post('password')),
			
		);

			$uid = array('user_id' => $user_id );

		$this->register_model->adduid($uid);
		 $result=$this->register_model->add_data($data);

		 if($result==TRUE)
		 {
		 	/*
			send email verification here and next time  he logins check if  email is verified
		 	*/
		 $first_name = $data['first_name'];
		 $last_name = $data['last_name'];
		 $uid = $data['user_id'];
		 $email = $this->input->post('email');
		 	$this->emailBody($first_name,$last_name,$uid,$email);
		 }
		 else

		 {
		 	$this->session->set_flashdata('message', 'Unknown error!!');	
			redirect(base_url().'index.php/home/register','refresh');
		 }
		}



		
	}

//email client
//Verification email body
//
public function emailBody($first_name,$last_name,$uid,$email)
{
	$link=base_url().'/index.php/register/verifyEmail/'.$uid.'';
		 //	print_r($link);
		 	$subject='Verify your account';
		 	$body='
		 		<html>
						<head>
							<title></title>
						</head>
						<body>
							<h1 style="text-align: center;">
								<strong>Email Verification</strong></h1>
							<p>
								&nbsp;</p>
							<h3>
								Welcome&nbsp;'.$first_name.' '.$last_name.'</h3>
							<p>
								You have successfully resgisted with couch surfing .Please click on the confirmation link below to verify your account.</p>
							<p>
								&nbsp;</p>
							<p style="text-align: center;">
								<a href='.$link.'><input name="confrim" type="button" value="Confirm your account" /></a>
								</p>
						</body>
				</html>


		 	';
		 		$email = str_replace(' ', '', $email);
		 		$this->sendEmail($subject,$body,$email);
}

	public function sendEmail($subject,$body,$email)
		{
		$configs = array(
			    'protocol'  =>  'smtp',
			    'smtp_host' =>  'smtp.gmail.com',
			    'smtp_user' =>  'dcst.unigoa@gmail.com',
			    'smtp_pass' =>  'goauniversity',
			    'smtp_port' =>  '587',
			    'smtp_crypto' => 'tls',
			    'mailtype' => 'html'
			     
			);



		$this->load->library("email");
		$this->email->initialize($configs);
        $this->email->set_newline("\r\n");
        $this->email->to($email);
        $this->email->from("dcst.unigoa@gmail.com", "Couch");
        $this->email->subject($subject);
        $this->email->message($body);

       
        if($this->email->send())
        {
           $this->session->set_flashdata('message', 'Verification mail has been sent to you!!');	
			redirect(base_url().'index.php/home/loginpage','refresh');
        }
        else
        {
            $this->session->set_flashdata('message', 'Error occured while sending email!!');	
			redirect(base_url().'index.php/home/emailVerification','refresh');   
        }
		}

		public function reVerify($value='')
		{
			$email=$this->input->get('email');
			$query = $this->register_model->reVerify($email);
			foreach ($query->result() as $row) {
							$uid      = $row->user_id;
						   $first_name=$row->first_name;
						   $last_name = $row->last_name;
				
			}
			$this->emailBody($first_name,$last_name,$uid,$email);

		}


		public function verifyEmail($uid)
		{
			//load function in model to make email verification flag as 1
			$result = $this->register_model->confirmEmail($uid);
			
			if(!$result){

				  $this->session->set_flashdata('message', 'Error occured while verifying email!!');	
				  redirect(base_url().'index.php/home/emailVerification','refresh'); 

			}elseif ($result==1) {
				# code...
				# send this data to controller
				# load login page
				$this->session->set_flashdata('message', 'Email is verified...You can login now!!');	
				redirect(base_url().'index.php/home/loginpage','refresh');

			}


		}


	




 }





/* End of file register.php */
/* Location: ./application/controllers/register.php */