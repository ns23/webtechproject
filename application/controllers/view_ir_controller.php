<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view_ir_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}


	public function request()
	{
				$uid= $this->session->userdata('uid');
    	
    	$sql="select * from (select user.user_id,user.first_name,user.last_name,user.profile,host_events.start_date,host_events.end_date from user,host_events where user.user_id=host_events.user_id) t1 ,reqeuests   where t1.user_id=reqeuests.sender_id and reqeuests.receiver_id='".$uid."'";


 	   	 $data['h'] = $this->db->query($sql);
     		$this->load->view('navbar');
     		$this->load->view('view_r',$data);
	}


	public function invites()
	{



	$uid= $this->session->userdata('uid');
    	
    	$sql="select * from (select user.user_id,user.first_name,user.last_name,user.profile,host_events.start_date,host_events.end_date from user,host_events where user.user_id=host_events.user_id) t1 ,invites where t1.user_id=invites.receiver_id and invites.sender_id='".$uid."'";


 	   	 $data['h'] = $this->db->query($sql);
     		$this->load->view('navbar');
     		$this->load->view('view_i',$data);









	}

}

/* End of file view_ir_controller */
/* Location: ./application/controllers/view_ir_controller */