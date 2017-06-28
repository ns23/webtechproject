<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Host_event extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('host_model');
	}

	public function index()
	{
		//This will load the registration view
		$this->load->view('navbar');
		$this->load->view('sidebar');
		$this->load->view('create_host_event');	
	}

	public function create_host_event()
	{
		
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$location=$this->input->post('location');
		//echo $location;
		$myArray = explode(',', $location);
		$max = sizeof($myArray);
		$country=$myArray[$max-1];
		$state=$myArray[$max-2];
		$locality=$myArray[$max-3];
		//echo $country;


			$event_id=uniqid();				
			$user_id=$this->session->userdata('uid');				
			
			$start_date = strtotime($start_date);
			$end_date = strtotime($end_date);
			$data = array(
				'event_id'   => $event_id,
				'user_id'      => $user_id,
				'start_date'   => $start_date,
				'end_date'      => $end_date,
				'country'      => $country,
				'state'   => $state,
				'locality'      => $locality,
				'full_address'      => $location,
		);
		
		 $result=$this->host_model->add_data($data);

		 if($result==TRUE)
		 {
		 	//redirect(base_url().'index.php/home/host_event','refresh');
			 	$sql="select * from user,user_address,user_info where (user_address.state sounds like '".$state."' or user_address.locality sounds like '".$locality."' or concat(user_address.state,' ',user_address.locality)sounds like '".$location."') and  user.user_id=user_address.user_id and user.user_id=user_info.user_id";
				$data['h'] = $this->db->query($sql);
				$this->session->set_flashdata('message', 'Event is created');
					redirect(base_url().'index.php/home/index','refresh');
				//$this->load->view('navbar');
				//$this->load->view('list_view',$data);
		 }
		 else
		 {
		 	$this->session->set_flashdata('message', 'Some error occured!!!');
					redirect(base_url().'index.php/home/index','refresh');
		 }

	}
}







/* End of file register.php */
/* Location: ./application/controllers/register.php */