<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search_controller extends CI_Controller { 
 
 public function __construct()  {
        parent:: __construct();
  $this->load->model("search_model");
  $this->load->helper("url");
  $this->load->helper('form');
    }
     
    public function index(){
        $this->load->view('search_view');
    }
     
         
           public function autocomplete() {
        $search_data = $this->input->post('search_data');
        //print_r($search_data);
       //$search_data="Pana";
     $query = $this->search_model->get_autocomplete($search_data);

       foreach ($query->result() as $row):
        //secho "string";
         echo "<li><a href='" . base_url() . "index.php/view_user_profile_controller/view/" . $row->user_id . "'>" . $row->last_name . "</a></li>";        // This link should take us to profile page of user
         // print_r($query);
     endforeach;
            //$this->load->view('show', $data);
    }
     
    
}
