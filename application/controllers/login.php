<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');		
	}


	public function index()
	{
		

		$email=$this->input->post('email');

		$data = array(
			'email'   => $email,
			'password'   => md5($this->input->post('password')),
			
		);

		$result=$this->login_model->verify_login($data);

		if($result=="0")
		{
			
			/*
				@user doesnot exits
				@set flash data to display error message
			*/
			 $this->session->set_flashdata('message', 'Email/password not correct!');	
			redirect(base_url().'index.php/home/loginpage','refresh');

		}else if ($result=="1") {
			# code...
			/*
				@login sucessfull
			*/
				redirect(base_url().'index.php/home/index','refresh');

		}else if ($result=="2") {
			# email not verfied
			 $this->session->set_flashdata('message', 'Please verify your email first!');
			redirect(base_url().'index.php/home/emailVerification','refresh');


		}


	}


	public function logout()
	{
		# when user logouts destroy all the sessions nad redirect him to index page
		$this->session->sess_destroy();
		redirect(base_url().'index.php/home/index','refresh');
	}
	


}



/* End of file login.php */
/* Location: ./application/controllers/login.php */