<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {

	public function __construct() {
        parent::__construct();
				if($this->session->userdata('logged_in')) {
					 $session_data = $this->session->userdata('logged_in');
					 $this->header['username'] = $session_data['username'];
				 } else {
					 redirect('login', 'refresh');
				 }
         $this->header['title']= "Mantenimiento Marca";
				 $this->header['url']= base_url();
				 $this->load->model("Marca_model","Marca");
				 $this->load->helper(array('form'));

				//cargo mis script de la carpeta dist/js/mantenimiento/
				// $this->footer['script'] = array('<script src="'.base_url().'dist/js/mantenimiento/marca.js"></script>');
    }


	public function index()
	{

	}


}


//END MARCA Controller
