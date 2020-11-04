<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorUsuario extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Usuario_model');
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
        $u_d_mensaje=$this->input->post('d_email_mensaje');
        $u_d_asunto = $this->input->post('d_email_asunto');
        $dataPersona=$this->Persona_model->obtenerPersona($dataDoctor['FK_d_p_id']);
        $dataD=array_merge($dataPersona,$dataDoctor);

        $dataPersonaUsu=$this->Persona_model->obtenerPersona($idPer_sesion);
        $dataUsu=$this->Usuario_model->obtenerUsuario($idPer_sesion);
        $dataU=array_merge($dataPersonaUsu,$dataUsu);
        if($this->enviaEmail($dataD,$dataU,$u_d_asunto,$u_d_mensaje)){
           echo "<script>alert('correo Enviado')</script>";
           redirect('registrar/ultimaRespuestaUsu', 'refresh');
            exit;
        }else{
                //no se pudo
                echo "<script>alert('no se pudo enviar, vuelve a escribir tu mensaje')</script>";
               redirect('DoctorUsuario/usuarioEmail', 'refresh');
                exit;    
        }
    }
    public function enviaEmail($dataD,$dataU,$u_d_asunto,$u_d_mensaje){
       // Load PHPMailer library
       $this->load->library('PHpmailer_lib');
        
       // PHPMailer object
       $mail = $this->phpmailer_lib->load();
       
       // SMTP configuration
       $mail->isSMTP();
       $mail->Host     = 'smtp.gmail.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'asistenteaee@gmail.com';
       $mail->Password = 'asistente433';
       $mail->SMTPSecure = 'tls';
       $mail->Port     = 587;
       
       $mail->setFrom('asistenteaee@gmail.com', $dataU['u_nombre'].' '.$dataU['u_apellido']);
       //$mail->addReplyTo('info@example.com', 'CodexWorld');
       
       // Add a recipient
       $mail->addAddress('ale03zeballos@gmail.com');    //$dataD['p_email']
       
       // Add cc or bcc 
//       $mail->addCC('cc@example.com');
  //     $mail->addBCC('bcc@example.com');
       
       // Email subject
       $mail->Subject = $u_d_asunto;
       
       // Set email format to HTML
       $mail->isHTML(true);
       
       // Email body content
       $mailContent = "<h1>AsistenteAEE</h1>
           <p> $u_d_mensaje </p>
           <p> Numero de cel: ".$dataU['u_telefono']." <br>
               Genero:  ".$dataU['u_sexo']." <br>
               Email de paciente:  ".$dataU['p_email']." <br>
               El Usuario solicito ayuda
           </p>";
       $mail->Body = $mailContent;
       
       // Send email
       if(!$mail->send()){
           echo 'Message could not be sent.';
           echo 'Mailer Error: ' . $mail->ErrorInfo;
           return false;
       }else{
           echo 'Message has been sent';
           return true;
       }
    }
    public function logoutDoctor(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
