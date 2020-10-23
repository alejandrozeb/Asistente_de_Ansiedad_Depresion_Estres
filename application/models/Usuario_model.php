<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{
    public function insertarUsuario($usuario_detalles){
        if(!$this->db->insert("usuario",$usuario_detalles))
             return false;
        else
            return true; 
    }
    public function obtenerIdUsuario($FK_p_id){
        $query = $this->db->select('PK_u_id')
                ->where('FK_p_id', $FK_p_id)
                ->get('usuario');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
    public function verificaUsuario($FK_p_id){
        $query = $this->db->get_where('usuario', array('FK_p_id' => $FK_p_id));
        if($query->row_array()==null)
            return false;
        else 
            return true;
    }
}

?>