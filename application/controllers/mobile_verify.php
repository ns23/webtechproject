<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_verify extends CI_Controller {


	public function index()
	{
		$this->load->model('mobile_verify_model');
		$this->mobile_verify_model->getnumber();
		$this->load->view('navbar');
		$this->load->view('sidebar');
		$this->load->view('mobile');
		//$this->load->view('footer');
	}

	public function try1($value='')
	{
		$this->load->view('navbar');
		$this->load->view('sidebar');
		$this->load->view('enter_otp');
		//$this->load->view('footer');
			
		# code...
	}

	public function otp()
	{
		$number = $this->input->get('mobileno');
		//print_r($number);
		$number = str_replace(' ', '', $number);
		$this->load->model('mobile_verify_model');
		$q = $this->mobile_verify_model->checkmobilenumber($number);

		if($q!=FALSE)
		{

		//$this->mobile_verify_model->insertNumber($number);

		$six_digit_random_number = mt_rand(100000, 999999);
		print_r($six_digit_random_number);
		$array = array(
			'OTP' => $six_digit_random_number,
			'currentnumber'=>$number
		);
		
		$this->session->set_userdata( $array );
		$res = $this->sendSMS($number,$six_digit_random_number);
		if($res==true)
		{
			$this->session->set_flashdata('message', '6 digit OTP hs been sent to your mobile  !!!');
			$this->load->view('navbar');
		$this->load->view('sidebar');
		$this->load->view('enter_otp');
		$this->load->view('footer');
			
		}
		}
		else
		{

			//echo "<script>alert('nnumber already registed');</script>";
			$this->session->set_flashdata('message', 'Number already registed !!!');
			redirect(base_url().'index.php/mobile_verify/index','refresh');

		}

	}

	
	public function sendSMS($number,$six_digit_random_number)
	{
		// Authorisation details.
		
		$username = "niteshsawant023@gmail.com";
		$hash = "";

		// Config variables. Consult http://api.textlocal.in/docs for more info.
		$test = "0";

		// Data for text message. This is the text message data.
		$sender = "TXTLCL"; // This is who the message appears to be from.
		$numbers = $number; // A single number or a comma-seperated list of numbers
		$message = "Your OTP number is ".$six_digit_random_number." OTP is valid till current session is active";
		// 612 chars or less
		// A single number or a comma-seperated list of numbers
		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		$ch = curl_init('http://api.textlocal.in/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); // This is the result from the API
		
		curl_close($ch);
		return true;
		//$this->load->view('enter_otp', $data, FALSE);
	}

	public function verifyotp()
	{
		$opt = $this->input->post('otp');
		
		if($opt == $this->session->userdata('OTP'))
		{
			//echo "OTP successfull";
			$this->load->model('mobile_verify_model');

			$number=$this->session->userdata('currentnumber');
			$this->mobile_verify_model->status($number);
			$this->mobile_verify_model->insertNumber($number);
			$this->session->set_flashdata('message', 'OTP Successfull!!!');
			$this->session->unset_userdata('OTP');
			$this->session->unset_userdata('currentnumber');
			redirect(base_url().'index.php/mobile_verify/index','refresh');
		}
		else
		{
			$this->session->set_flashdata('message', 'OTP is wrong !!!');
			//echo "OTP is wrong";
			redirect(base_url().'index.php/mobile_verify/try1','refresh');
			//redirect('http://localhost/webtech_project/index.php/mobile_verify/try1','refresh');
		}


	}

}

/* End of file mobile_verify.php */
/* Location: ./application/controllers/mobile_verify.php */
