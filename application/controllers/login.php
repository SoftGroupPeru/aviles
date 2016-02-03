<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('usuario_model','Usuario',TRUE);
   $this->data['url']= base_url();
   $this->load->helper(array('form'));
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     redirect('home', 'refresh');
   }
   else
   {
     $this->load->view('login_view',$this->data);
   }

 }

 function recovery()
 {
   $this->load->view('recovery_view', $this->data);
 }

 function verify()
 {
   $email = $this->input->post('txtemail');
   $result = $this->Usuario->recovery($email); //comprobamos si el correo existe

   if($result) {
     $sess_array = array();
     $password = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
     $this->Usuario->update_password($result[0]->idUsuario, $password);
     //echo $password;
     /*
     FALTA ENVIAR POR CORREO
     */
     $this->data['msj'] = array(1, 'Su nueva contraseña se enviará a su correo.');
     $this->load->view('recovery_view', $this->data);
   } else {
     $this->data['msj'] = array(2, 'El correo ingresado no existe.');
     $this->load->view('recovery_view', $this->data);
   }

 }


}
