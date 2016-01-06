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
   $this -> db -> where('clave', $password);
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
   $this->db->select('idUsuario, usuario, correo, nombre, apellido, direccion, estado');
   $this->db->from('usuario');
   $consulta = $this->db->get();
   $resultado = $consulta->result();
   return $resultado;
 }




}
