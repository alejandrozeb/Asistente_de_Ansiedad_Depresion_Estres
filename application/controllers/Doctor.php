<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Doctor_model');

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
            $d_nombre=$this->input->post('d_nombre');
            $d_apellido = $this->input->post('d_apellido');
            $d_telefono = $this->input->post('d_telefono');
            $p_email = $this->input->post('p_email');
            $p_password =md5($this->input->post('p_password'));
            //echo ' '.$d_nombre.' '.$d_apellido.' '.$d_telefono.' '.$p_email.' '.$p_password;
        }
        $verificaemail=$this->Persona_model->verificarEmail($p_email);
        if($verificaemail!=null){
            $this->output->set_status_header(301);
            echo "<script>alert('Email ya registrado')</script>";
            redirect('Doctor', 'refresh');  
            exit;
        }
		$persona_detalles = array(
            'p_email' => $p_email,
            'p_password' => $p_password
        );
        if(!$this->Persona_model->insertarPersona($persona_detalles)){
            $this->output->set_status_header(500);
            echo json_encode(array('msg' => 'Error al crear la instancia Persona'));
            exit;
        }else{
            $FK_id_p=$this->Persona_model->obtenerId($p_email);
            if($FK_id_p==null){
                $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al obtener el id'));
                exit;
            }
            $doctor_detalles = array(
                'd_nombre' => $d_nombre,
                'd_apellido' => $d_apellido,
                'd_telefono' => $d_telefono,
                'FK_p_id' =>$FK_id_p['PK_p_id']
            );
            if(!$this->Doctor_model->insertarDoctor($doctor_detalles)){
                $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al crear Doctor'));
                exit;
            }
            $idDoctor=$this->Doctor_model->obtenerIdDoctor($FK_id_p['PK_p_id']);
            if($idDoctor==null){
                $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al obtener id'));
                exit;
            }
            echo 'Id Doctor'.$idDoctor['PK_d_id'].' id Persona'.$FK_id_p['PK_p_id']; 
            $this->output->set_status_header(200);
			//redireccionar
			redirect('Doctor/resultadosDoctor', 'refresh'); 
        }
    }
    
    public function ingresaDoctor(){
        $this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('doctor/loginDoctor');
		$this->load->view('templates/footer');
    }
    public function ingresarDocProceso(){
        if($this->input->post('d_login')){
            $p_email = $this->input->post('p_email');
            $p_password =md5($this->input->post('p_password'));
            echo 'Email: '.$p_email.' password: '.$p_password;
        }
    }
	
	public function resultadosDoctor(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('doctor/resultadosDoc');
		$this->load->view('templates/footer');
	}
    
}
