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

    public function enviaEmailContacto(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $dataContacto=$this->Contacto_model->obtenerContacto($idPer_sesion);

        $dataPersonaUsu=$this->Persona_model->obtenerPersona($idPer_sesion);
        $dataUsu=$this->Usuario_model->obtenerUsuario($idPer_sesion);
        $dataU=array_merge($dataPersonaUsu,$dataUsu);
        if($this->enviaEmail($dataContacto,$dataU)){
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

    public function enviaEmail($dataContacto,$dataU){
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
        
        $mail->setFrom('asistenteaee@gmail.com', $dataContacto['c_nombre'].' '.$dataContacto['c_apellido']);
        //$mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress($dataContacto['c_email']);    //$dataD['p_email']
        
        // Add cc or bcc 
 //       $mail->addCC('cc@example.com');
   //     $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Tu amig@ necesita ayuda';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>AsistenteAEE</h1>
            <p> Numero de cel: ".$dataU['u_telefono']." <br>
                Genero:  ".$dataU['u_sexo']." <br>
                Email de paciente:  ".$dataU['p_email']." <br>
                El Usuario solicito ayuda, el te eligio como su contacto de emergencia, por favor comunicate  que necesita mucho hablar respecto a su salud mental (niveles de Depresion, Ansiedad y Estres muy altos). 
            </p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }else{
            //echo 'Message has been sent';
            return true;
        }
     }

    public function logoutContacto(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
