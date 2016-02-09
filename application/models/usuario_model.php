<?php

Class Usuario_model extends CI_Model {
 function login($username, $password) {
   $this -> db -> select('idUsuario, usuario, clave');
   $this -> db -> from('Usuario');
   $this -> db -> where('usuario', $username);
   $this -> db -> where('clave', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
//para las cookies
 function login2($username, $password) {
   $this -> db -> select('idUsuario, usuario, clave');
   $this -> db -> from('Usuario');
   $this -> db -> where('usuario', $username);
   $this -> db -> where('clave', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if ($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }

 function verifica_user($username) {
   $this -> db -> select('usuario');
   $this -> db -> from('Usuario');
   $this -> db -> where('usuario', $username);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if ($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }

 function verifica_correo($correo) {
   $this -> db -> select('usuario');
   $this -> db -> from('Usuario');
   $this -> db -> where('correo', $correo);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if ($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }

 function recovery($correo) {
   $this -> db -> select('idUsuario, usuario');
   $this -> db -> from('Usuario');
   $this -> db -> where('correo', $correo);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if ($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }

 function update_password($id, $new_password) {
   $this->db->set('clave', MD5($new_password))
            ->set('nombre', $new_password)
            ->where('idUsuario',$id)
            ->update('Usuario');
 }

 public function Listar(){
   $this->db->select('idUsuario, usuario, correo, nombre, apellido, estado');
   $this->db->from('usuario');
   $consulta = $this->db->get();
   $resultado = $consulta->result();
   return $resultado;
 }

 public function Insertar($data){
   $arr = array(
              'usuario' => $data['usuario'],
              'clave' => $data['pass'],
              'nombre' => $data['nombre'],
              'apellido' => $data['apellido'],
              'correo' => $data['correo'],
              'estado' => $data['estado'],
              'created_at' => date("Y-m-d")
           );
   if($this->db->insert('usuario', $arr)) return true;
   else return false;
 }

 public function Cargar($id){
   $this->db->select('idUsuario, usuario, correo, nombre, apellido, estado');
   $this->db->from('usuario');
   $this->db->where('idUsuario', $id);
   $this->db->limit(1);
   $consulta = $this->db->get();
   $resultado = $consulta->row();
   return $resultado;
 }

 public function Editar($data){

   $arr = array(
         'usuario' => $data['usuario'],
         'nombre' => $data['nombre'],
         'apellido' => $data['apellido'],
         'correo' => $data['correo'],
         'estado' => $data['estado'],
         'updated_at' => date("Y-m-d")
        );
   if ( $data["pass"] != "" ) {
      $arr['clave'] = MD5($data['pass']);
   }
   $this->db->where('idUsuario', $data['id']);
   if($this->db->update('usuario', $arr)) return true;
   else return false;
 }

 public function activardesactivar($data){
   $arr = array(
         'estado' => $data['estado']
         //'fecha_registro' => date("Y-m-d")  FALTA PONER FECHA DE REGISTRO EN LA BD
        );
   $this->db->where('idUsuario', $data['id']);
   if($this->db->update('usuario', $arr)) return true;
   else return false;
 }

}
