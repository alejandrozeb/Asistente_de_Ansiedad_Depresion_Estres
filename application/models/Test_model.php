<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model{
    public function insertarTest($test_detalles){
        if(!$this->db->insert("test",$test_detalles))
             return false;
        else
            return true; 
    }
}

?>