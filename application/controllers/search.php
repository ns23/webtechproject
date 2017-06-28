<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller {

	public function index()
	{
		$this->load->model('search_model');
	
	}

	public function get()
	{

		$select=$this->input->post('select');
		$val=$this->input->post('search_val');
	
		switch($select) {
    case 'Enter location to find hosts':
   
    	$uid= $this->session->userdata('uid');
    	$location=$val;
    	


      $sql="select * from user,user_address,user_info where (user_address.state sounds like '".$location."' or user_address.locality sounds like '".$location."' or concat(user_address.state,' ',user_address.locality)sounds like '".$location."' or concat(user_address.locality,' ',user_address.state)sounds like '".$location."' or user_address.district sounds like '".$location."') and  user.user_id=user_address.user_id and user.user_id=user_info.user_id and user.user_id <> '".$uid."' ";
 	    $data['h'] = $this->db->query($sql);
     
      $sql1="select distinct event_id FROM host_events WHERE user_id='".$uid."' limit 0,1";
    $data1 = $this->db->query($sql1);
 

    if ($data1->num_rows()!=0) {
      foreach ($data1->result() as $key) {
      # code...
      $event_id = $key->event_id;  
    }

    $this->session->set_flashdata('event_id', $event_id);
      # code...
    }
    



    $this->load->view('navbar');
     $this->load->view('list_view',$data);

    break;


    case 'People':
    	//User will enter users name and the output will be list of users matching that name
		$uid= $this->session->userdata('uid');    
		$people=$val;
		
$sql="select * from user,user_address,user_info where((concat(user.first_name,' ',user.last_name)sounds like '".$people."') or (user.first_name sounds like '".$people."')or(user.last_name sounds like '".$people."'))and user.user_id=user_address.user_id and user.user_id=user_info.user_id and user.user_id <> '".$uid."' ";

$data['h'] = $this->db->query($sql);

	




     
      $sql1="select distinct event_id FROM host_events WHERE user_id='".$uid."' limit 0,1";
    $data1 = $this->db->query($sql1);
 

    if ($data1->num_rows()!=0) {
      foreach ($data1->result() as $key) {
      # code...
      $event_id = $key->event_id;  
    }

    $this->session->set_flashdata('event_id', $event_id);
      # cod


}




		$this->load->view('navbar');
      $this->load->view('list_view',$data);
    
      break;






    case 'Enter location':
    	//User will enter location and the output will be list of people visiting that location (created events);
    	$uid= $this->session->userdata('uid');
         $location=$val;

         
      	 $sql="select DISTINCT user.user_id,user.email,user.first_name,user.last_name,user_address.state,host_events.start_date,host_events.end_date,user_info.about_me,user_info.interests,user_info.gender,user.profile,user_address.locality,host_events.state from user,user_address,host_events,user_info where  (user_address.state sounds like '".$location."' or user_address.locality sounds like '".$location."' or concat(user_address.state,' ',user_address.locality)sounds like '".$location."' or concat(user_address.locality,' ',user_address.state)sounds like '".$location."' or user_address.district sounds like '".$location."') and user_address.user_id=user.user_id and user.user_id=host_events.user_id and host_events.user_id=user_address.user_id and user.user_id=user_info.user_id";
      	 //  $data['h'] = $this->db->query($sql);
         // $sql="select event_id from host_events where host_events.user_id='".$uid."'";
          $data['h'] = $this->db->query($sql);


$this->load->view('navbar');
      	 $this->load->view('list_view_events',$data);
    	
          break;
    default:

}








	}

}