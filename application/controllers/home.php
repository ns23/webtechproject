<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


public function __construct()
{
	parent::__construct();
	if($this->session->userdata('uid')) {

      $this->message_count();

	}
}


	public function index()
	{
		//$this->msg_count();
		//$this->message_count();
		$this->load->view('navbar');
		$this->load->view('home_view');
		$this->load->view('footer');
	}

	public function loginpage($value='')
	{
		# load this page if th elogin fails for any reason
		$this->load->view('navbar'); 
		$this->load->view('loginpage');
		$this->load->view('footer');


	}

	public function emailVerification($value='')
	{
		# code...
		$this->load->view('navbar');
		$this->load->view('emailVerification');
		$this->load->view('footer');

	}

	public function register($value='')
	{
		# code to do open registeration page
		$this->load->view('navbar');
		$this->load->view('register_view');
		$this->load->view('footer');


	}

	public function message_count($value='')
	{
		
		$uid= $this->session->userdata('uid');
		$uid = str_replace(' ', '', $uid);
	    $sql="select count(status) as c from message where receiver_id='".$uid."' and status=0";
		$query = $this->db->query($sql);

		foreach ($query->result() as $row)  
        {  
             // echo '<h5>  Unread Messages :   '.$row->c.'   </h5>';

        	$array = array(
        		'msg_count' => $row->c
        	);
        	
        	$this->session->set_userdata( $array );

        }
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */