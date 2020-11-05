<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto_model extends CI_Model{
    public function insertarContacto($contacto_detalles){
        if(!$this->db->insert("contacto",$contacto_detalles))
             return false;
        else
            return true; 
    }

    public function obtenerIdContacto($FK_p_id){
        $query = $this->db->select('PK_u_id')
                ->where('FK_u_p_id', $FK_p_id)
                ->get('contacto');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }

    public function obtenerContacto($FK_p_id){
        $query = $this->db->select('*')
                ->where('FK_u_p_id', $FK_p_id)
                ->get('contacto');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }

    public function verificaVacioContacto($FK_u_p_id,$FK_u_id){
        $query = $this->db->select('*')
                ->where('FK_u_p_id', $FK_u_p_id)
                ->where('Fk_u_id', $FK_u_id)
                ->get('contacto');
        if(isset($query))
            return $query->last_row();
        else
            return null;
    }

    public function updateContacto($FK_u_p_id,$FK_u_id,$dataContacto){
        $query = $this->db->where('FK_u_p_id', $FK_u_p_id)
                ->where('Fk_u_id', $FK_u_id)
                ->update('contacto', $dataContacto);
        if(isset($query))
            return true;
        else
            return null;
    }
}
?>