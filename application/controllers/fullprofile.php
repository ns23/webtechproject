<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fullprofile extends CI_Controller {

	public function index($userid='')
	{
		//$userid='5728eb6b91ea8';
		$this->load->model('fullprofile_model');
		$query = $this->fullprofile_model->getdata($userid);

		if($query!=FALSE)
		{
			foreach ($query->result() as $row)
			{
				$this->session->set_flashdata('first_name', $row->first_name);
				$this->session->set_flashdata('last_name', $row->last_name);
				$dob = date("d F Y", $row->dob);
				$this->session->set_flashdata('dob', $dob);
				$this->session->set_flashdata('mobile_number', $row->mobile_number);
				$this->session->set_flashdata('profile', $row->profile);//profile pic
				$this->session->set_flashdata('street_address', $row->street_address);
				$this->session->set_flashdata('district', $row->district);
				$this->session->set_flashdata('locality', $row->locality);
				$this->session->set_flashdata('zipcode', $row->zipcode);
				$this->session->set_flashdata('state', $row->state);
				$this->session->set_flashdata('lat', $row->lat);
				$this->session->set_flashdata('lon', $row->lon);
				$this->session->set_flashdata('about_me', $row->about_me);
				$this->session->set_flashdata('interests', $row->interests);
				$this->session->set_flashdata('pets', $row->pets);
				$this->session->set_flashdata('drinks', $row->drinks);
				$this->session->set_flashdata('guest_count', $row->guest_count);
				$this->session->set_flashdata('gender', $row->gender);
				$this->session->set_flashdata('rid', $userid);

			  	
			   
			}

			$this->load->view('navbar');
				$this->load->view('fullprofile_view');
		}
		else{
			redirect(base_url().'index.php/home/index','refresh');
		}
		}




	

	}



/* End of file fullprofile.php */
/* Location: ./application/controllers/fullprofile.php */