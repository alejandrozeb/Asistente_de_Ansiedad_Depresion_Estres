<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model{
    public function insertarTest($test_detalles){
        if(!$this->db->insert("test",$test_detalles))
             return false;
        else
            return true; 
    }
    public function obtenerTestsUsu($FK_p_id, $FK_u_id){
        $query = $this->db->select('*')
                ->where('FK_u_p_id', $FK_p_id)
                ->where('FK_u_id', $FK_u_id)
                ->get('test');
        if(isset($query))
            return $query->result_array();
        else
            return null;
    }
    public function obtenerUltimoTestUsu($FK_p_id, $FK_u_id){
        $query = $this->db->select('*')
                ->where('FK_u_p_id', $FK_p_id)
                ->where('FK_u_id', $FK_u_id)
                ->get('test');
        if(isset($query))
            return $query->last_row();
        else
            return null;
    }
}

?>