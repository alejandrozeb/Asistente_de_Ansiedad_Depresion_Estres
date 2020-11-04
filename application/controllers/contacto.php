<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contacto extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Usuario_model');
        $this->load->model('Contacto_model');
	} 

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('usuario/registrarContacto');
		$this->load->view('templates/footer');
    }

    public function registrarContacto(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $form=$this->input->post('c_registrar');
        echo $form;
        $c_nombre=$this->input->post('c_nombre');
        $c_apellido=$this->input->post('c_apellido');
        $c_email=$this->input->post('c_email');

        echo $c_nombre.' '.$c_apellido.' '.$c_email;
    }

    public function logoutContacto(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
