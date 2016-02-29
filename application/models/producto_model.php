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

      public function Listar(){        
        $this->db->select('p.idProducto,p.nombre,p.codigo_barra,p.stock,p.serie,p.parte,p.cantidad,p.ubicacion,p.descripcion,p.imagen,p.estado,m.nombre Marca_idMarca,p.producto_nuevo,p.producto_seminuevo');
        $this->db->from('producto p');
        $this->db->join('marca m', 'm.idMarca = p.Marca_idMarca');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado ;
      }


       public function Cargar($id){
         $this->db->select('idProducto,nombre,codigo_barra,stock,serie,parte,cantidad,ubicacion,descripcion,imagen,estado,Marca_idMarca,producto_nuevo,producto_seminuevo');
         $this->db->from('producto');
         $this->db->where('idProducto', $id);
         $this->db->limit(1);
         $consulta = $this->db->get();
         $resultado = $consulta->row();
         return $resultado;
       }

       public function buscarimgant($id){
         $this->db->select('imagen');
         $this->db->from('producto');
         $this->db->where('idProducto',$id);
         $this->db->limit(1);
         $consulta = $this->db->get();
         $resultado = $consulta->row();
         return $resultado;
       }

        public function Editar($data){
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
               'producto_nuevo' => $data['cheknuevo'] , 
               'producto_seminuevo' => $data['chekseminuevo']  
              );        
         $this->db->where('idProducto', $data['id']);
         if($this->db->update('producto', $arr)) return true;
         else return false;
       }


        public function activardesactivar($data){
           $arr = array(
                 'estado' => $data['estado']
                 //'fecha_registro' => date("Y-m-d")  FALTA PONER FECHA DE REGISTRO EN LA BD
                );
           $this->db->where('idProducto', $data['id']);
           if($this->db->update('producto', $arr)) return true;
           else return false;
        }
}

?>