<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('usuario_model','',TRUE);
   $this->data['url']= base_url();
   $this->load->helper('cookie');
 }

 function index()
 {
   $username = $this->input->post('username');
   if ($this->input->cookie('usu_r40')) {
     $username = $this->input->cookie('usu_r40');
     $password = $this->input->cookie('pass_r40');
     $result = $this->usuario_model->login2($username, $password);
     if($result) {
       $sess_array = array();
       foreach($result as $row) {
         $sess_array = array(
           'id' => $row->idUsuario,
           'username' => $row->usuario
         );
         $this->session->set_userdata('logged_in', $sess_array);
       }
       redirect('home', 'refresh');
     } else {
       $this->load->view('login_view');
     }
   }

   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->data['msj'] = 'Contraseña incorrecta';
     $this->load->view('login_view',$this->data);
   }
   else
   {
     if ($this->input->post('checkrecordar')) {
        $login = $this->input->post('username');
        $pass = md5($this->input->post('password'));

        $this->input->set_cookie('usu_r40', $login, time () + 604800);
        $this->input->set_cookie('pass_r40', $pass, time () + 604800);
     } //end if

     //Go to private area
     redirect('home', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->usuario_model->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->idUsuario,
         'username' => $row->usuario
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Contrasena incorrecta');
     return false;
   }
 }
}
