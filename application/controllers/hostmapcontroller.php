<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hostmapcontroller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('hostmapmodel');

	}

	public function index()
	{
			$this->load->model('hostmapmodel');
			$data['h'] = $this->hostmapmodel->view();
			$this->load->view('navbar');
			$this->load->view('sidebar');
			$this->load->view('hostmap', $data);
	}
}

/* End of file hostmapcontroller.php */
/* Location: ./application/controllers/hostmapcontroller.php */