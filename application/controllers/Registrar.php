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
            //echo ' '.$u_nombre.' '.$u_apellido.' '.$u_date.' '.$u_telefono.' '.$u_genero.' '.$p_email.' '.$p_password;
        }
        $verificaemail=$this->Persona_model->verificarEmail($p_email);
        if($verificaemail!=null){
            $this->output->set_status_header(301);
            echo "<script>alert('Email ya registrado')</script>";
            redirect('registrar', 'refresh');  
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
            redirect('registrar/preguntasUsuario', 'refresh'); 
        }
        
    }
    public function ingresaUsuario(){
        $this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('usuario/loginUsuario');
		$this->load->view('templates/footer');
    }
    public function ingresarUsuProceso(){
        if($this->input->post('u_login')){
            $p_email = $this->input->post('p_email');
            $p_password =md5($this->input->post('p_password'));
        }
        $data=$this->Persona_model->loginPersona($p_email,$p_password);
         if($data==null){
            $this->output->set_status_header(500);
            echo "<script>alert('No estas registrado en la plataforma')</script>";
            redirect('registrar/ingresaUsuario', 'refresh');
            exit;
        }  
        if(!$this->Usuario_model->verificaUsuario($data['PK_p_id'])){
            //error
            $this->output->set_status_header(500);
            echo "<script>alert('Debes Registrarte como Usuario')</script>";
            redirect('registrar/ingresaUsuario', 'refresh');
            exit;
        }else{
            $this->output->set_status_header(200);
            $Usuario = $this->Usuario_model->obtenerUsuario($data['PK_p_id']);
                    $idPersona=$data['PK_p_id'];
                    $idUsuario=$Usuario['Pk_u_id'];
                    $data=array(
                        'persona' => $idPersona,
                        'usuario' => $idUsuario,
                        'nombre' => $Usuario['u_nombre'],
                        'apellido' => $Usuario['u_apellido'],
                        'is_logged' => TRUE
                    );
                    $this->session->set_userdata($data); 
                //var_dump($data);
			//redireccionar
			redirect('registrar/preguntasUsuario', 'refresh');
        }
     }
    public function preguntasUsuario(){
        $this->load->view('usuario/templatesUsu/header');
		$this->load->view('usuario/templatesUsu/nav');
		$this->load->view('usuario/preguntasUsu');
        $this->load->view('usuario/templatesUsu/footer');
    }
    public function preguntasUsuarioProceso(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $form=$this->input->post('u_preguntas');
        $u_pre1=$this->input->post('u_pre1');
        $u_pre2=$this->input->post('u_pre2');
        $u_pre3=$this->input->post('u_pre3');
        $u_pre4=$this->input->post('u_pre4');
        $u_pre5=$this->input->post('u_pre5');
        $u_pre6=$this->input->post('u_pre6');
        $u_pre7=$this->input->post('u_pre7');
        echo $idPer_sesion.' '.$idUsu_sesion.' '.$form.' '.$form1.' '.$form2;
        //crear directorio

        //crear json

        //guardar json con respuestas y fecha  en directorio

        //calculos

        //guardar en bd
        
        //desplegar vista de resultados

    }

    public function logoutUsuario(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
    }
}