<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');		
	
	}

	public function index()
	{
		//This will load the registration view
		$this->load->view('navbar');	
		$this->load->view('location_edit');		
	}

	public function try1($value='')
	{
		$this->load->view('header');
	}

	public function address()
	{
		$user_id=$this->session->userdata('uid');			//need to get this from session variable
		//echo $user_id;
		$street_address=$this->input->post('street_address');
		//echo $street_address;	
		$district=$this->input->post('district');
		$locality=$this->input->post('locality');
		//echo $locality;
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

		 $this->session->set_flashdata('message', 'Your address is now updated!!!');
		 redirect(base_url().'index.php/edit_location/index','refresh');
	

	}



 }



?>

