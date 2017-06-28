<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_update extends CI_Controller {
// change name,,password
	public function index()
	{
		//check if the session is set else redirect user to login page
		if($this->session->userdata('uid'))
		{
			//
			$this->load->model('my_account_model');
			$data['h'] = $this->my_account_model->view();
			//print_r($data);
			$this->load->view('navbar');
			$this->load->view('sidebar');
			$this->load->view('account_update_view', $data);
			// $this->load->view('footer');
			


		}
		else
		{
			$this->session->set_flashdata('message', 'Login first to access account!!!');	
			redirect(base_url().'index.php/home/loginpage','refresh');
		}
	}


	public function my_profile($value='')
	{
		#displays option to edit profile
		$this->load->view('my_profile_view');

	}


	public function update_profile()
	{

if($this->input->post('password'))
			{

			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
 			
		

			$data = array
			(
			'first_name'   => $first_name,
			'last_name'   => $last_name,
			'password'   => md5($this->input->post('password')),
			);
 
		 $this->load->model('my_account_model');
 		 $result=$this->my_account_model->with_password($data);
			}
			else

			{
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');

			$data = array
			(
			'first_name'   => $first_name,
			'last_name'   => $last_name,
			);
 
		$this->load->model('my_account_model');
 		 $result=$this->my_account_model->without_password($data);
 		

 		}

 		$this->session->set_flashdata('message', 'Account Details are updated');
 		redirect(base_url().'index.php/account_update/index','refresh');
	




	}

}

/* End of file my_account.php */
/* Location: ./application/controllers/my_account.php */