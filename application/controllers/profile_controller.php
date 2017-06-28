	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->getdata();
		$this->load->view('navbar');
		$this->load->view('sidebar');
		$this->load->view('pet');
	}


	public function profile()
	{

   	$uid= $this->session->userdata('uid');
		$pets=$this->input->post('pets');
		$drinks=$this->input->post('drinks');
		$gender=$this->input->post('gender');
		$guest_count=$this->input->post('guests');
		  $sql="update user_info set pets='".$pets."',drinks='".$drinks."',guest_count='".$guest_count."',gender='".$gender."' where user_id='".$uid."'";
		   $query = $this->db->query($sql);
		   $this->session->set_flashdata('message', 'Information Updated');
		   redirect(base_url().'index.php/profile_controller','refresh');
	}

	public function getdata($value='')
	{
			$uid= $this->session->userdata('uid');
			$this->db->where('user_id', $uid);
			$query = $this->db->get('user_info');

			foreach ($query->result() as $key) {
				$this->session->set_flashdata('pets1', $key->pets);
				$this->session->set_flashdata('drink1', $key->drinks);
				$this->session->set_flashdata('gc1', $key->guest_count);
				$this->session->set_flashdata('sex', $key->gender);
			}
	}

}

/* End of file profile_controller.php */
/* Location: ./application/controllers/profile_controller.php */