<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_location extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');		
	}

	public function index()
	{
		//This will load the registration view
		if($this->session->userdata('uid'))
		{
			$this->load->view('navbar');
			$this->load->view('sidebar');	
			$this->load->view('location_edit');
			$this->load->view('footer');
		}
		else
		{
			$this->session->set_flashdata('message', 'Login first to change address!!!');	
			redirect(base_url().'index.php/home/loginpage','refresh');
		}
				
	}

	public function try1($value='')
	{
		$this->load->view('navbar');
	}

	public function address()
	{
		$user_id=$this->session->userdata('uid');			//need to get this from session variable
		echo $user_id;
		$street_address=$this->input->post('street_address');
		echo $street_address;	
		$district=$this->input->post('district');
		$locality=$this->input->post('locality');
		echo $locality;
		$zipcode=$this->input->post('zipcode');
		$state=$this->input->post('state');
		$lat=$this->input->post('lat');
		$lon=$this->input->post('lon');

		$data = array(
			'user_id'   => $user_id,
			'street_address'   => $street_address,
			'district'   => $district,
			'locality'   => $locality,
			'zipcode'      => $zipcode,
			'state'      => $state,
			'lat'      => $lat,
			'lon'      => $lon,
			
		);
		
		$result=$this->profile_model->add_data($data);
	}
 }
		
?>

