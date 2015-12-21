<?php

Class Usuario_model extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('idUsuario, usuario, clave');
   $this -> db -> from('Usuario');
   $this -> db -> where('usuario', $username);
   $this -> db -> where('clave', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>
