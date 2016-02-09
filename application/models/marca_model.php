<?php

Class Marca_model extends CI_Model {
  public function Listar(){
    $this->db->select('idMarca,nombre, descripcion, imagen, estado');
    $this->db->from('marca');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function Insertar($data){
    $arr = array(
               'marca' => $data['nombre'],
               'imagen' => $data['imagen'],
               'descripcion' => $data['descripcion'],
               'estado' => $data['estado'],
            );
    if($this->db->insert('marca', $arr)) return true;
    else return false;
  }

  public function Cargar($id){
    $this->db->select('idMarca, nombre , descripcion, estado');
    $this->db->from('marca');
    $this->db->where('idMarca', $id);
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->row();
    return $resultado;
  }

  public function Editar($data){

    $arr = array(
          'nombre' => $data['nombre'],
          'descripcion' => $data['descripcion'],
          'estado' => $data['estado']
         );
    $this->db->where('idMarca', $data['id']);
    if($this->db->update('marca', $arr)) return true;
    else return false;
  }

  public function activardesactivar($data){
    $arr = array(
          'estado' => $data['estado']
          //'fecha_registro' => date("Y-m-d")  FALTA PONER FECHA DE REGISTRO EN LA BD
         );
    $this->db->where('idMarca', $data['id']);
    if($this->db->update('marca', $arr)) return true;
    else return false;
  }

}
