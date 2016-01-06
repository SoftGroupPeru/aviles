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
				$this->load->helper('cookie');
    }

	public function index()
	{
		$this->load->view('header_view',$this->header);
		$this->load->view('aside_view');
		$this->load->view('home_view');
		$this->load->view('footer_view');
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('msj');
		delete_cookie('usu_r40');
		delete_cookie('pass_r40');
		session_destroy();
		redirect('home', 'refresh');
	}
}


//END HOME Controller
