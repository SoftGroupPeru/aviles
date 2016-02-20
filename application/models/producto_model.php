<?php
class Producto_model extends CI_Model
{
	
public function Insertar($data){

	
   $arr = array(
              'nombre' => $data['nombre'],
              'codigo_barra' => $data['codbarra'],
              'serie' => $data['serie'],
              'parte' => $data['parte'],
              'cantidad' => $data['cantidad'],
              'ubicacion' => $data['ubicacion'],
              'descripcion' => $data['descripcion'],
              'imagen' => $data['img'],
              'estado' => $data['estado'],
              'Marca_idMarca' => $data['marca'],
              'producto_nuevo' => $data['cheknuevo'],
              'producto_seminuevo' => $data['chekseminuevo']
           );
   if($this->db->insert('producto', $arr)) return true;
   else return false;
 }

public function buscarnombreimg($nombre_img){
    $this->db->select('imagen');
    $this->db->from('producto');
    $this->db->like('imagen',$nombre_img);   
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;

}

}


?>