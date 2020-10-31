<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorUsuario_model extends CI_Model{
    public function insertarDoctorUsuario($doctorUsuario_detalles){
        if(!$this->db->insert("doctor_usuario",$doctorUsuario_detalles))
             return false;
        else
            return true; 
    }
    public function verificaVacio($FK_p_id,$FK_u_id){
        $query = $this->db->select('*')
                ->where('FK_p_id', $FK_p_id)
                ->where('FK_u_id', $FK_u_id)
                ->get('doctor_usuario ');
        if(isset($query))
            return $query->result_array();
        else
            return null;
    }
    public function obtenerIdDoctor($FK_p_id){
        $query = $this->db->select('*')
                ->where('FK_p_id', $FK_p_id)
                ->get('doctor');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
    
}

?>