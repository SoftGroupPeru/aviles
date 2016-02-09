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
				 $this->load->model("marca_model","Marca");
				 $this->load->helper(array('form'));

				//cargo mis script de la carpeta dist/js/mantenimiento/
				 $this->footer['script'] = array('<script src="'.base_url().'dist/js/mantenimiento/marca.js"></script>');
    }


	public function index()
	{
		$data['arr_marcas'] = $this->Marca->Listar();
		$this->load->view('header_view', $this->header);
		$this->load->view('aside_view');
		$this->load->view('mantenimiento/marca_view', $data);
		$this->load->view('footer_view', $this->footer);
	}


	public function listar()
	{
		if($this->input->is_ajax_request()){
			$data['datos'] = $this->Marca->Listar();
			$data['rst'] = 1;
			echo json_encode($data);
		}
	}

	public function crear()
	{
		if($this->input->is_ajax_request()){
			$data['nombre'] = $this->input->post('nombre');
			$data['imagen'] = $this->input->post('imagen');
			$data['descripcion'] = $this->input->post('descripcion');
			$data['estado'] = $this->input->post('estado');

			if($this->Marca->Insertar($data)) {
				$data['rst'] = 1;
				$data['msj'] = 'Marca registrada correctamente';
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'Ocurrio un error en el registro de la marca';
			}
			echo json_encode($data);
		}
	}


	public function cargar()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');

			$data = $this->Marca->Cargar($id);
			echo json_encode($data);
		}
	}

	public function editar()
	{
		if($this->input->is_ajax_request()){
			$data['id'] = $this->input->post('id');
			$data['marca'] = $this->input->post('marca');
			$data['descripcion'] = $this->input->post('descripcion');
			$data['estado'] = $this->input->post('estado');

			if($this->Marca->Editar($data)) {
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

		if($this->Marca->activardesactivar($data)) {
			$data['rst'] = 1;
			$data['msj'] = 'Marca actualizado correctamente';
		} else {
			$data['rst'] = 0;
			$data['msj'] = 'Marca un error en la actualización';
		}
		echo json_encode($data);
	}


}


//END MARCA Controller
