<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Producto extends CI_Controller{

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
				 
				 $this->load->model("Marca_model","Marca");
                 $this->load->model("Producto_model","Producto");
				 //$this->load->helper(array('form'));
                 //$this->load->library('form_validation');
				 $this->footer['script'] = array('<script src="'.base_url().'dist/js/mantenimiento/producto.js"></script>');
    }


    public function index()
    {    	
		$this->load->view('header_view', $this->header);
		$this->load->view('aside_view');
		$this->load->view('mantenimiento/producto_view');
		//$this->load->view('mantenimiento/producto_view', $data);		
		$this->load->view('footer_view', $this->footer);
	
    }

    public function listarmarca(){
    	if($this->input->is_ajax_request()) {    	
    	   $data['arr_marcas'] = $this->Marca->Listar();
    	   @$nombremarca = array();
    	   for ($i=0; $i < count($data['arr_marcas']) ; $i++) { 
    		$nombremarca[$data['arr_marcas'][$i]->idMarca]=$data['arr_marcas'][$i]->nombre ;
    	   } 
    	   $nombremarca['cantidad'] = count($data['arr_marcas']);
    	   $nombremarca['rst'] = 1;      	    	   	
    	   echo json_encode($nombremarca); 
    	} 
    }

    public function crear() {
        if ($this->input->is_ajax_request()){
                $data['nombre'] = $this->input->post('txt_nombre');
                $data['codbarra'] = $this->input->post('txt_codbarra');
                $data['serie'] = $this->input->post('txt_serie');
                $data['parte'] = $this->input->post('txt_parte');
                $data['cantidad'] = $this->input->post('txt_cantidad');
                $data['ubicacion'] = $this->input->post('txt_ubicacion');
                $data['descripcion'] = $this->input->post('txt_descripcion');                
                $data['estado'] = $this->input->post('slct_estado');
                $data['marca'] = $this->input->post('slct_marca'); 
                
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
                        if(!is_dir("images/productos/")) { mkdir("images/productos", 0777,true); }   

                        if (is_file("images/productos/".$nombre_img.$ext))  {                            
                            $num_repit = count($this->Producto->buscarnombreimg($nombre_img)) ; 
                            $data['img'] = $nombre_img.$num_repit.$ext ;
                               
                            move_uploaded_file($_FILES['archivo']['tmp_name'],"images/productos/".$nombre_img.$num_repit.$ext) ;
                        }else{
                            $data['img'] = $nombre_img.$ext ;
                            move_uploaded_file($_FILES['archivo']['tmp_name'],"images/productos/".$nombre_img.$ext) ;
                        }                        
                    }
                    else{
                       throw new Exception("Error Processing Request", 1);   
                    }

                    if ($this->input->post('chek_producto')=== "pnuevo") {
                        $data['cheknuevo'] = 1;
                        $data['chekseminuevo'] = NULL;
                    } else {
                        $data['chekseminuevo'] = 1;
                        $data['cheknuevo'] = NULL;
                    }

                    if($this->Producto->Insertar($data)) {
                    $data['rst'] = 1;
                    $data['msj'] = 'Producto registrado correctamente';
                    } else {
                    $data['rst'] = 0;
                    $data['msj'] = 'Ocurrio un error en el registro de Producto';
                    }
            }
                echo json_encode($data);
        }      
     }

    public function listar(){       
        if ($this->input->is_ajax_request()){

            $data['datos'] = $this->Producto->Listar() ;
            $data['rst'] = 1;           
            echo json_encode($data);
        }

    }

    public function cargar(){        
        
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');

           $data = $this->Producto->Cargar($id);
           echo json_encode($data);          
        }
    }

    public function editar()
    {   
        if ($this->input->is_ajax_request()){     
                $data['id'] = $this->input->post('txt_id');  
                $data['nombre'] = $this->input->post('txt_nombre');
                $data['codbarra'] = $this->input->post('txt_codbarra');
                $data['serie'] = $this->input->post('txt_serie');
                $data['parte'] = $this->input->post('txt_parte');
                $data['cantidad'] = $this->input->post('txt_cantidad');
                $data['ubicacion'] = $this->input->post('txt_ubicacion');
                $data['descripcion'] = $this->input->post('txt_descripcion');                
                $data['estado'] = $this->input->post('slct_estado');
                $data['marca'] = $this->input->post('slct_marca'); 
                
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
                        if(!is_dir("images/productos/")) { mkdir("images/productos", 0777,true); }

                        if ($file == "") {
                            //-- NO SE EDITARA IMAGN  - NO CREAR Y NO ELIMINAR
                            $img_ant = $this->Producto->buscarimgant($data['id']) ; 
                            $data['img'] = $img_ant->imagen ;
                        }else{

                            if (is_file("images/productos/".$nombre_img.$ext))  {  
                                    
                                    $num_repit = count($this->Producto->buscarnombreimg($nombre_img)) ; 
                                    $data['img'] = $nombre_img.$num_repit.$ext ;
                                    //--borrar imagen anterior
                                    $img_ant = $this->Producto->buscarimgant($data['id']) ;                             
                                    unlink("images/productos/".$img_ant->imagen);
                                    move_uploaded_file($_FILES['archivo']['tmp_name'],"images/productos/".$nombre_img.$num_repit.$ext) ;
                                    
                                }else{
                                    $data['img'] = $nombre_img.$ext ;
                                    $img_ant = $this->Producto->buscarimgant($data['id']) ; 
                                    //print_r($img_ant) ;

                                    unlink("images/productos/".$img_ant->imagen);
                                    move_uploaded_file($_FILES['archivo']['tmp_name'],"images/productos/".$nombre_img.$ext) ;
                                }  
                        }
                    }
                    else{
                       throw new Exception("Error Processing Request", 1);   
                    }

                    if ($this->input->post('chek_producto')=== "pnuevo") {
                        $data['cheknuevo'] = 1;
                        $data['chekseminuevo'] = NULL;
                    } else {
                        $data['chekseminuevo'] = 1;
                        $data['cheknuevo'] = NULL;
                    }

                    if($this->Producto->Editar($data)) {
                    $data['rst'] = 1;
                    $data['msj'] = 'Producto actualizado correctamente';
                    } else {
                    $data['rst'] = 0;
                    $data['msj'] = 'Ocurrio un error en la actualizacion del Producto';
                    }
            }
                echo json_encode($data);
        } 
        
    }


    public function cambiarestado()
    {
        $estado = $this->input->post('estado');

        $data['estado'] = ($estado == 1)?'0':'1';
        $data['id'] = $this->input->post('id');

        if($this->Producto->activardesactivar($data)) {
            $data['rst'] = 1;
            $data['msj'] = 'Producto actualizado correctamente';
        } else {
            $data['rst'] = 0;
            $data['msj'] = 'Ocurrio un error en la actualización';
        }
        echo json_encode($data);
    }

}




?>