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
        $c_nombre=$this->input->post('c_nombre');
        $c_apellido=$this->input->post('c_apellido');
        $c_email=$this->input->post('c_email');

        $data_contacto= array(
            'c_nombre' => $c_nombre,
            'c_apellido' => $c_apellido,
            'c_email' => $c_email,
            'Fk_u_id' => $idUsu_sesion,
            'FK_u_p_id' => $idPer_sesion
        );
        
        if(!$this->Contacto_model->insertarContacto($data_contacto)){
            $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al crear usuario'));
                exit;
        }
            $this->output->set_status_header(200);
            //redireccionar
            redirect('registrar/ultimaRespuestaUsu', 'refresh');         
    }
    
    public function verificaContacto(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }

        ///verica si tiene Contacto
        $dataContacto=$this->Contacto_model->verificaVacioContacto($idPer_sesion,$idUsu_sesion);
        if(empty($dataContacto)){
            //ingresa contacto
            $this->output->set_status_header(200);
            redirect('contacto', 'refresh');

        }else{
            //cargar la pagina del doctor
            $this->output->set_status_header(200);
            //mostrar el contacto con la opcion de cambiarlo
            $this->session->set_userdata('dataContacto', $dataContacto);
            redirect('contacto/mostrarContacto', 'refresh');
        }
    }

    public function mostrarContacto()
	{
		$this->load->view('templates/header');
		$this->load->view('usuario/mostrarContacto');
		$this->load->view('templates/footer');
    }

    public function actualizarContacto(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $form=$this->input->post('c_actualizarContacto');
        $c_nombre=$this->input->post('c_nombre');
        $c_apellido=$this->input->post('c_apellido');
        $c_email=$this->input->post('c_email');
        $data_contacto= array(
            'c_nombre' => $c_nombre,
            'c_apellido' => $c_apellido,
            'c_email' => $c_email,
            'Fk_u_id' => $idUsu_sesion,
            'FK_u_p_id' => $idPer_sesion
        );
        if(!$this->Contacto_model->updateContacto($idPer_sesion,$idUsu_sesion,$data_contacto)){
            $this->output->set_status_header(500);
                echo json_encode(array('msg' => 'Error al actualizar el update'));
                exit;
        }
            $this->output->set_status_header(200);
            //redireccionar
            echo "<script>alert('Contacto Actualizado')</script>";
            redirect('registrar/ultimaRespuestaUsu', 'refresh');        

    }

    public function logoutContacto(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
