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
}
