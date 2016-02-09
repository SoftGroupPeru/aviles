<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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

				 $this->footer['script'] = array('<script src="'.base_url().'dist/js/mantenimiento/usuario.js"></script>');
    }


	public function index()
	{
		$data['arr_usuarios'] = $this->Usuario->Listar();
		$this->load->view('header_view', $this->header);
		$this->load->view('aside_view');
		$this->load->view('mantenimiento/usuario_view', $data);
		$this->load->view('footer_view', $this->footer);
	}

	public function listar()
	{
		if($this->input->is_ajax_request()){
			$data['datos'] = $this->Usuario->Listar();
			$data['rst'] = 1;
			echo json_encode($data);
		}
	}

	public function crear()
	{
		if($this->input->is_ajax_request()){
			$data['usuario'] = $this->input->post('usuario');
			$data['pass'] = $this->input->post('pass');
			$data['nombre'] = $this->input->post('nombre');
      $data['apellido'] = $this->input->post('apellido');
			$data['correo'] = $this->input->post('correo');
			$data['estado'] = $this->input->post('estado');

			if($this->Usuario->Insertar($data)) {
				$data['rst'] = 1;
				$data['msj'] = 'Usuario registrado correctamente';
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'Ocurrio un error en el registro de usuario';
			}
			echo json_encode($data);
		}
	}

	public function cargar()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');

			$data = $this->Usuario->Cargar($id);
			echo json_encode($data);
		}
	}

	public function editar()
	{
		if($this->input->is_ajax_request()){
			$data['id'] = $this->input->post('id');
			$data['usuario'] = $this->input->post('usuario');
			$data['pass'] = $this->input->post('pass');
			$data['nombre'] = $this->input->post('nombre');
			$data['apellido'] = $this->input->post('apellido');
			$data['correo'] = $this->input->post('correo');
			$data['estado'] = $this->input->post('estado');

			if($this->Usuario->Editar($data)) {
				$data['rst'] = 1;
			//	$data['msj'] = 'Usuario actualizado correctamente';
				$data['msj'] = $this->db->last_query();
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'Ocurrio un error en la actualización';
			}
			echo json_encode($data);
		}
	}

	public function cambiarestado()
	{
		$estado = $this->input->post('estado');

		$data['estado'] = ($estado == 1)?'0':'1';
		$data['id'] = $this->input->post('id');

		if($this->Usuario->activardesactivar($data)) {
			$data['rst'] = 1;
			$data['msj'] = 'Usuario actualizado correctamente';
		} else {
			$data['rst'] = 0;
			$data['msj'] = 'Ocurrio un error en la actualización';
		}
		echo json_encode($data);
	}

	public function verifica_user()	{
		if($this->input->is_ajax_request()){
			$data['username'] = $this->input->post('username');
			$data['id'] = $this->input->post('id'); //para editar debe permitir mostrar su valor actual
			$resultado = $this->Usuario->verifica_user($data);
			if($resultado) {
				$data['rst'] = 1; //existe
			} else {
				$data['rst'] = 0;
			}
			echo json_encode($data);
		}
	}

	public function verifica_correo()	{
		if($this->input->is_ajax_request()){
			$data['correo'] = $this->input->post('correo');
			$data['id'] = $this->input->post('id'); //para editar debe permitir mostrar su valor actual
			$resultado = $this->Usuario->verifica_correo($data);
			if($resultado) {
				$data['rst'] = 1;
			} else {
				$data['rst'] = 0;
			}
			echo json_encode($data);
		}
	}

	public function verificacion()	{
		if($this->input->is_ajax_request()){
			$username = $this->input->post('username');
			$correo = $this->input->post('correo');

			$user_exist = $this->Usuario->verifica_user($username);
			$correo_exist = $this->Usuario->verifica_correo($correo);

			if($user_exist && $correo_exist) {
				$data['rst'] = 3;
			} elseif($user_exist) {
				$data['rst'] = 2;
			} elseif($correo_exist) {
				$data['rst'] = 1;
			} else {
				$data['rst'] = 0;
			}
			echo json_encode($data);
		}
	}

}


//END USUARIO Controller
