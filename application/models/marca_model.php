<?php

Class Marca_model extends CI_Model {
  public function Listar(){
    $this->db->select('idMarca,nombre, descripcion, imagen, estado');
    $this->db->from('marca');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }





}
