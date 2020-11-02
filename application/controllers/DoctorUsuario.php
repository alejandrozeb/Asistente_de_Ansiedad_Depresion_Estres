<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorUsuario extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Doctor_model');
        $this->load->model('DoctorUsuario_model');

	} 

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('registrarDoctor');
		$this->load->view('templates/footer');
    }
    
    public function verificaDoctor(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }

        ///verica si tiene doctor
        $verifica=$this->DoctorUsuario_model->verificaVacio($idPer_sesion,$idUsu_sesion);
        var_dump($verifica);
        if(empty($verifica)){
            echo 'Mostrar que doctores puede elegir';
            $dataDoctores=$this->Doctor_model->obtenerTodosLosDoctores();
            $this->session->set_userdata('dataDoctores', $dataDoctores);
            redirect('DoctorUsuario/eligeDoctor', 'refresh');
            var_dump($dataDoctores);

        }else{
            //cargar la pagina del doctor
            echo 'Mostrar la vista, datos de contacto del doctor y la opcion de redactar un email';
        }
    }

    public function eligeDoctor(){
        $this->load->view('usuario/templatesUsu/header');
		$this->load->view('usuario/eligeDoctor');
        $this->load->view('usuario/templatesUsu/footer');
    }

    public function eligeDoctorProcess($idDoctor,$idPersona){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        //insertarDocotr
        $data_detalles=array(
            'FK_d_id' => $idDoctor,
            'FK_p_id' => $idPersona,
            'FK_p_id' => $idPer_sesion,
            'Fk_u_id' => $idUsu_sesion,
        );
        if(!$this->DoctorUsuario_model->insertarDoctorUsuario($data_detalles)){
            $this->output->set_status_header(500);
            echo json_encode(array('msg' => 'Error al crear la instancia Doctor_usuario'));
            exit;
        }else{
            //exito
            $this->output->set_status_header(500);
            echo json_encode(array('msg' => 'Error al crear la instancia Doctor_usuario'));
            exit;
        }
    }
    
    public function logoutDoctor(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
