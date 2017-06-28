<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_message_screen_controller extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('main_message_screen_model');
	}

	public function index()
	{
		
	}


	public function view()				
	{
		//echo "<script>alert('view');</script>";

			$sender_id=$this->input->post('sender_id');
			$receiver_id=$this->input->post('receiver_id');
			

			if($this->input->post('sender_id'))
			{

				$newdata = array
				(
                   'sender_id'  => $sender_id,
                   'receiver_id'     => $receiver_id,
                   
               	);

				$this->session->set_userdata($newdata);
				$sender_id = $this->session->userdata('sender_id');
				$receiver_id = $this->session->userdata('receiver_id');
			}
			else
			{
				
				$sender_id = $this->session->userdata('sender_id');
				$receiver_id = $this->session->userdata('receiver_id');
			}
			//echo $sender_id;
			//echo $receiver_id;
			


			$uid= $this->session->userdata('uid');
			$uid = str_replace(' ', '', $uid);	


		
			
			$data = array
			(
			'sender_id'   => $sender_id,
			'receiver_id'   => $receiver_id,
			);
 

 			$this->load->model('main_message_screen_model');  
			$result1=$this->main_message_screen_model->view($data);

			//Reading Of messages
		   $sql="update message set status=1			
		   WHERE message.receiver_id='".$uid."' and message.sender_id='".$sender_id."' ";
		   $query = $this->db->query($sql);
	//redirect('Main_message_screen_controller/view');
		   $data['h'] = $this->main_message_screen_model->view($data);

		  // $this->load->view('main_message_screen', $data);
		  // redirect('Main_message_screen_controller/view2');
		   $this->load->view('navbar');
				$this->load->view('sidebar');
		  redirect(base_url().'index.php/Main_message_screen_controller/view2','refresh');
}







public function view2()					//JUST FOR VIEWING THE MESSAGES
	{
	//echo "<script>alert('view2');</script>";

$this->load->helper('form');
			//$this->load->view('navbar');
			//	$this->load->view('sidebar');
				$sender_id = $this->session->userdata('sender_id');
				$receiver_id = $this->session->userdata('receiver_id');
				

			$uid= $this->session->userdata('uid');
			$uid = str_replace(' ', '', $uid);	

			
			$data = array
			(
			'sender_id'   => $sender_id,
			'receiver_id'   => $receiver_id,
			);
 

 			$this->load->model('main_message_screen_model');  
			//$result1=$this->main_message_screen_model->view($data);
			$data['h'] = $this->main_message_screen_model->view($data);

		   $this->load->view('main_message_screen', $data);


}
















	//function for inserting new message
	public function view1()
	{

		//echo "<script>alert('view1');</script>";
			$message=$this->input->post('message');
			$sender_id=$this->input->post('sender_id');
			$receiver_id=$this->input->post('receiver_id');
			//$sender_id=$this->session->userdata('uid');
			//echo $receiver_id;
			//echo $receiver_id;
			//$sender_id='5728eb9691511';
			//$receiver_id=' 5728eb6b91ea8';
			//$sender_id = $this->session->userdata('sender_id');
			//$receiver_id = $this->session->userdata('receiver_id');
			$this->load->model('main_message_screen_model');  


			$time = time();
			$data = array
			(
			'message_id'=>uniqid(),	
			'sender_id'   => $sender_id,
			'receiver_id'   => $receiver_id,
			'message'   => $message,
			'time'      => $time,
			);

			 $result1=$this->main_message_screen_model->view1($data);

 			redirect(base_url().'index.php/Main_message_screen_controller/view2','refresh');
 			



	}














}

