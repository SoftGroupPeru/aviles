<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();
				if($this->session->userdata('logged_in')) {
			     $session_data = $this->session->userdata('logged_in');
			     $this->header['username'] = $session_data['username'];
			   } else {
			     redirect('login', 'refresh');
			   }
         		$this->header['title']= "Aviles";
				$this->header['url']= base_url();
    }

	public function index()
	{
		$this->load->view('welcome_message',$this->header);
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('msj');
		session_destroy();
		redirect('home', 'refresh');
	}
}


//END HOME Controller
