<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');

	} 

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('registrarDoctor');
		$this->load->view('templates/footer');
    }
    public function registrarDoctor()
	{
		if($this->input->post('d_registrar')){
            $u_nombre=$this->input->post('d_nombre');
            $u_apellido = $this->input->post('d_apellido');
            $u_telefono = $this->input->post('d_telefono');
            $p_email = $this->input->post('p_email');
            $p_password =md5($this->input->post('p_password'));
            echo ' '.$u_nombre.' '.$u_apellido.' '.$u_telefono.' '.$p_email.' '.$p_password;
        }
    }
    
}
