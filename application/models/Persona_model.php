<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model{
    public function insertarPersona($persona_detalles){
        if(!$this->db->insert("persona",$persona_detalles))
             return false;
        else
            return true; 
    }
    public function crearPersona($persona_detalles){
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
}

?>