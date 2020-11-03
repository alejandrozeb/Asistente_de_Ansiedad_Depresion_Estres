<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model{
    public function insertarPersona($persona_detalles){
        if(!$this->db->insert("persona",$persona_detalles))
             return false;
        else
            return true; 
    }
    public function obtenerId($email){
        $query = $this->db->select('PK_p_id')
                ->where('p_email', $email)
                ->get('persona');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
    public function verificarEmail($email){
        $query = $this->db->select('PK_p_id')
        ->where('p_email', $email)
        ->get('persona');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
    public function loginPersona($p_email,$p_password){
        $query = $this->db->select('PK_p_id')
                ->where('p_email', $p_email)
                ->where('p_password', $p_password)
                ->get('persona');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
    public function obtenerPersona($id){
        $query = $this->db->select('*')
                ->where('PK_p_id', $id)
                ->get('persona');
        if(isset($query))
            return $query->row_array();
        else
            return null;
    }
}

?>