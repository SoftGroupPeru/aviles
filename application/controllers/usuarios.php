<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
				 $this->load->model("Usuario_model","Usuario");
				 $this->load->helper(array('form'));
    }


	public function index($msj = null)
	{
		$data['msj'] = $msj;
		$data['arr_usuarios'] = $this->Usuario->Listar();
		$this->load->view('header_view', $this->header);
		$this->load->view('aside_view');
		$this->load->view('mantenimiento/usuarios/usuario_view', $data);
		$this->load->view('footer_view');
	}


}


//END USUARIO Controller
