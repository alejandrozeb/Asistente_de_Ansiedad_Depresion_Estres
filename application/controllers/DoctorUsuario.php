<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorUsuario extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Doctor_model');
        $this->load->model('DoctorUsuario_model');
        $this->load->library('email');

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
            $this->output->set_status_header(200);
            $dataDoctores=$this->Doctor_model->obtenerTodosLosDoctores();
            $this->session->set_userdata('dataDoctores', $dataDoctores);
            redirect('DoctorUsuario/eligeDoctor', 'refresh');

        }else{
            //cargar la pagina del doctor
            $this->output->set_status_header(200);
            $dataDoctor=$this->Doctor_model->obtenerDoctor($verifica[0]['FK_d_p_id']);
            $this->session->set_userdata('dataDoctor', $dataDoctor);
            redirect('DoctorUsuario/usuarioEmail', 'refresh');
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
            'PK_d_id' => $idDoctor,
            'FK_d_p_id' => $idPersona,
            'FK_u_p_id' => $idPer_sesion,
            'Pk_u_id' => $idUsu_sesion,
        );
        if(!$this->DoctorUsuario_model->insertarDoctorUsuario($data_detalles)){
            $this->output->set_status_header(500);
            echo json_encode(array('msg' => 'Error al crear la instancia Doctor_usuario'));
            exit;
        }else{
            //exito
            var_dump($data_detalles);
        }
    }

    public function usuarioEmail(){
        $this->load->view('usuario/templatesUsu/header');
		$this->load->view('usuario/usuarioEmailDoctor');
        $this->load->view('usuario/templatesUsu/footer');
    }
    public function usuarioEmailProcess(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        $dataDoctor = $this->session->userdata('dataDoctor');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        echo $this->input->post('d_email_usu');
        $u_d_mensaje=$this->input->post('d_email_mensaje');
        $u_d_asunto = $this->input->post('d_email_asunto');
        $dataPersona=$this->Persona_model->obtenerPersona($dataDoctor['FK_d_p_id']);
        $data=array_merge($dataPersona,$dataDoctor);
        var_dump($data);
        $this->enviaEmail('alejandrojzeballos','vacio','hi','mi primer mensaje  con php');


    }
    public function enviaEmail($to,$from,$subject,$mensaje){
        $this->email->to($to);
        $this->email->from('ale03zeballos@gmail.com');
        $this->email->subject($subject);
        $this->email->message($mensaje);
        $this->email->send();
    }
    public function logoutDoctor(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
