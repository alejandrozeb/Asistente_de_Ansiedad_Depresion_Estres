<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrar extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Usuario_model');

	} 

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('registrar');
        $this->load->view('templates/footer');
    }
    
    public function registrarUsuario(){
        
        if($this->input->post('u_registrar')){
            $u_nombre=$this->input->post('u_nombre');
            $u_apellido = $this->input->post('u_apellido');
            $u_date = $this->input->post('u_date');
            $u_telefono = $this->input->post('u_telefono');
            $u_genero = $this->input->post('u_genero');
            $p_email = $this->input->post('p_email');
            $p_password =md5($this->input->post('p_password'));
            echo ' '.$u_nombre.' '.$u_apellido.' '.$u_date.' '.$u_telefono.' '.$u_genero.' '.$p_email.' '.$p_password;
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
            $usuario_detalles = array(
                'u_nombre' => $u_nombre,
                'u_apellido' => $u_apellido,
                'u_fechanac' => $u_date,
                'u_telefono' => $u_telefono,
                'u_sexo' => $u_genero,
                'FK_p_id' =>$FK_id_p['PK_p_id']
            );
            if(!$this->Usuario_model->insertarUsuario($usuario_detalles)){
                $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al crear usuario'));
                exit;
            }
            $idUsuario=$this->Usuario_model->obtenerIdUsuario($FK_id_p['PK_p_id']);
            if($idUsuario==null){
                $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al obtener id'));
                exit;
            }
            //echo $idUsuario['PK_u_id'].' '.$FK_id_p['PK_p_id']; 
            $this->output->set_status_header(200);
            //redireccionar
        }
        
	}
}