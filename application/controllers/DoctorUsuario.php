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
        if($this->enviaEmail($data['p_email'],$u_d_asunto,$u_d_mensaje)){
            echo "<script>alert('correo Enviado')</script>";
            redirect('registrar/ultimaRespuestaUsu', 'refresh');
            exit;
        }else{
                //no se pudo
                echo "<script>alert('no se pudo enviar')</script>";
                redirect('registrar/ultimaRespuestaUsu', 'refresh');
                exit;
        }


    }
    public function enviaEmail($to,$subject,$mensaje){
        $this->email->set_newline("\r\n");
        //Indicamos el protocolo a utilizar
        $config['protocol'] = 'smtp';
         
       //El servidor de correo que utilizaremos
        $config["smtp_host"] = 'smtp.gmail.com';
         
       //Nuestro usuario
        $config["smtp_user"] = 'asistenteaee@gmail.com';
         
       //Nuestra contraseña
        $config["smtp_pass"] = 'asistente433';   
         
       //El puerto que utilizará el servidor smtp
        $config["smtp_port"] = '25';
        
       //El juego de caracteres a utilizar
        $config['charset'] = 'utf-8';
 
       //Permitimos que se puedan cortar palabras
        $config['wordwrap'] = TRUE;
         
       //El email debe ser valido 
       $config['validate'] = true;
       
        
      //Establecemos esta configuración
        $this->email->initialize($config);
 
      //Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->from('asistenteaee@gmail.com', 'Alejandro Zeballos');
         
      /*
       * Ponemos el o los destinatarios para los que va el email
       * en este caso al ser un formulario de contacto te lo enviarás a ti
       * mismo
       */
        $this->email->to($to);
         
      //Definimos el asunto del mensaje
        $this->email->subject($subject);
         
      //Definimos el mensaje a enviar
        $this->email->message($mensaje);
         
        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if($this->email->send()){
            echo 'Email enviado correctamente';
            echo $this->email->print_debugger(array('headers'));
            return false;
        }else{
            //pruebas en el host, no puedo definirlo en localhost
            echo 'No se a enviado el email';
            echo $this->email->print_debugger(array('headers'));
            return true;
        }
    }
    public function logoutDoctor(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
