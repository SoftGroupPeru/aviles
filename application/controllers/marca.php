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
			$data['nombre'] = $this->input->post('txt_marca');			
			$data['descripcion'] = $this->input->post('txt_descripcion');
			$data['estado'] = $this->input->post('slct_estado');

			$file = $_FILES['archivo']['name'];
            $peso = $_FILES['archivo']['size'];

            if ($peso >= 1000000) {
                    $data['peso'] = 1 ;
                    $data['msj'] = 'Imagen supera el peso';
                } else {

                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
                    {
                        //obtenemos el archivo a subir                       
                        
                        $nombre = substr($file, 0, -4) ;
                        $num_caract = strlen($nombre);                    
                        $nombre_img = strtolower($this->input->post('txt_img'));
                        $ext = substr($file, $num_caract, 6) ;     

                        //comprobamos si existe un directorio para subir el archivo
                        //si no es así, lo creamos
                        if(!is_dir("images/marcas/")) { mkdir("images/marcas", 0777,true); }   

                        if (is_file("images/marcas/".$nombre_img.$ext))  {                            
                            $num_repit = count($this->Marca->buscarnombreimg($nombre_img)) ; 
                            $data['img'] = $nombre_img.$num_repit.$ext ;
                               
                            move_uploaded_file($_FILES['archivo']['tmp_name'],"images/marcas/".$nombre_img.$num_repit.$ext) ;
                        }else{
                            $data['img'] = $nombre_img.$ext ;
                            move_uploaded_file($_FILES['archivo']['tmp_name'],"images/marcas/".$nombre_img.$ext) ;
                        }                        
                    }
                    else{
                       throw new Exception("Error Processing Request", 1);   
                    }
                    

                    if($this->Marca->Insertar($data)) {
                    $data['rst'] = 1;
                    $data['msj'] = 'Marca registrado correctamente';
                    } else {
                    $data['rst'] = 0;
                    $data['msj'] = 'Ocurrio un error en el registro de Marca';
                    }
            }
           
			echo json_encode($data);
		}
	}

	public function editar()
	{
		if($this->input->is_ajax_request()){
			$data['id'] = $this->input->post('txt_id');
			$data['nombre'] = $this->input->post('txt_marca');
			$data['descripcion'] = $this->input->post('txt_descripcion');
			$data['estado'] = $this->input->post('slct_estado');

			$file = $_FILES['archivo']['name'];
            $peso = $_FILES['archivo']['size'];

            if ($peso >= 1000000) {
                    $data['peso'] = 1 ;
                    $data['msj'] = 'Imagen supera el peso';
                } else {

                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
                    {
                        //obtenemos el archivo a subir   
                        $nombre = substr($file, 0, -4) ;
                        $num_caract = strlen($nombre);                    
                        $nombre_img = strtolower($this->input->post('txt_img'));
                        $ext = substr($file, $num_caract, 6) ;     

                        //comprobamos si existe un directorio para subir el archivo
                        //si no es así, lo creamos
                        if(!is_dir("images/marcas/")) { mkdir("images/marcas", 0777,true); }

                        if ($file == "") {
                            //-- NO SE EDITARA IMAGN  - NO CREAR Y NO ELIMINAR
                            $img_ant = $this->Marca->buscarimgant($data['id']) ; 
                            $data['img'] = $img_ant->imagen ;
                        }else{

                            if (is_file("images/marcas/".$nombre_img.$ext))  {  
                                    
                                    $num_repit = count($this->Marca->buscarnombreimg($nombre_img)) ; 
                                    $data['img'] = $nombre_img.$num_repit.$ext ;
                                    //--borrar imagen anterior
                                    $img_ant = $this->Marca->buscarimgant($data['id']) ;                             
                                    unlink("images/marcas/".$img_ant->imagen);
                                    move_uploaded_file($_FILES['archivo']['tmp_name'],"images/marcas/".$nombre_img.$num_repit.$ext) ;                                    
                                }else{
                                    $data['img'] = $nombre_img.$ext ;
                                    $img_ant = $this->Marca->buscarimgant($data['id']) ; 
                                    //print_r($img_ant) ;
                                    if (is_file("images/marcas/".$img_ant->imagen)) {
                                        unlink("images/marcas/".$img_ant->imagen);
                                    }                                    
                                    move_uploaded_file($_FILES['archivo']['tmp_name'],"images/marcas/".$nombre_img.$ext) ;
                                }  
                        }
                    }
                    else{
                       throw new Exception("Error Processing Request", 1);   
                    }                    

                    if($this->Marca->Editar($data)) {
                    $data['rst'] = 1;
                    $data['msj'] = 'Marca actualizado correctamente';
                    } else {
                    $data['rst'] = 0;
                    $data['msj'] = 'Ocurrio un error en la actualizacion del Marca';
                    }
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
