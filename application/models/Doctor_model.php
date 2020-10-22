<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model{
    public function insertarDoctor($doctor_detalles){
        if(!$this->db->insert("doctor",$doctor_detalles))
             return false;
        else
            return true; 
    }
    public function obtenerIdDoctor($FK_p_id){
        $query = $this->db->select('PK_d_id')
                ->where('FK_p_id', $FK_p_id)
                ->get('doctor');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
}

?>