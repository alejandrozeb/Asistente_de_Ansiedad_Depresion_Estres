<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrar extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');

	} 

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('registrar');
        $this->load->view('templates/footer');
    }
    
    public function registrarUsuario(){
        $registro=$this->input->post('u_registrar');
        $u_nombre=$this->input->post('u_nombre');
        $u_apellido = $this->input->post('u_apellido');
        $u_date = $this->input->post('u_date');
        $u_telefono = $this->input->post('u_telefono');
        $u_genero = $this->input->post('u_genero');
        $p_email = $this->input->post('p_email');
        $p_password = $this->input->post('p_password');
        echo $registro.' '.$u_nombre.' '.$u_apellido.' '.$u_date.' '.$u_telefono.' '.$u_genero.' '.$p_email.' '.$p_password;
	}
}
