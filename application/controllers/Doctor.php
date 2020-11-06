<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Usuario_model');
        $this->load->model('Doctor_model');
        $this->load->model('Test_model');
        $this->load->model('DoctorUsuario_model');

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
                'FK_d_p_id' =>$FK_id_p['PK_p_id']
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
        }
        $data=$this->Persona_model->loginPersona($p_email,$p_password);
        if($data==null){
            $this->output->set_status_header(500);
            echo "<script>alert('No estas registrado')</script>";
            redirect('Doctor/ingresaDoctor', 'refresh');
            exit;
        }
        if(!$this->Doctor_model->verificaDoctor($data['PK_p_id'])){
            //error
            echo 'error';
            $this->output->set_status_header(500);
            echo "<script>alert('Debes Registrarte como doctor')</script>";
            redirect('Doctor/ingresaDoctor', 'refresh');
            exit;
        }else{
            $this->output->set_status_header(200);
            $doctor = $this->Doctor_model->obtenerDoctor($data['PK_p_id']);
                    $idPersona=$data['PK_p_id'];
                    $idDoctor=$doctor['PK_d_id'];
                    $data=array(
                        'persona' => $idPersona,
                        'doctor' => $idDoctor,
                        'nombre' => $doctor['d_nombre'],
                        'apellido' => $doctor['d_apellido'],
                        'is_logged' => TRUE
                    );
            $this->session->set_userdata($data);
            //data de todo para mostrar a sus pacientes
            if($this->pacientesDocProcess($idDoctor,$idPersona)){
                //redireccionar
			    redirect('Doctor/resultadosDoctor', 'refresh');     
            }

        }
    }
	
	public function resultadosDoctor(){
		$this->load->view('templates/header');
		$this->load->view('doctor/resultadosDoc');
		$this->load->view('templates/footer');
    }

    public function pacientesDocProcess($idDoc,$idPer){
        //idennntificar los paciente
            $dataPaciente=$this->DoctorUsuario_model->obtenerPacientes($idPer,$idDoc);
            var_dump($dataPaciente);
            $dataArrayPac=array();
            foreach ($dataPaciente as $Paciente) {
                $dataPer=$this->Persona_model->obtenerPersona($Paciente['FK_u_p_id']);                
                $dataUsuario=$this->Usuario_model->obtenerUsuario($Paciente['FK_u_p_id']);
                $dataPacTotal=array_merge($dataPer,$dataUsuario);
                array_push($dataArrayPac,$dataPacTotal);
            }
            var_dump($dataArrayPac);
        //llevar a la session
        $this->session->set_userdata('dataPacientes',$dataArrayPac);
        //volver al controlador principal
        return true;
    }

    public function estadisticaResultadoUsuProcess($dataPer,$dataUsu){
        $idPer_sesion = $this->session->userdata('persona');
        $idDoc_sesion = $this->session->userdata('doctor');
        if($idPer_sesion==null || $idDoc_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $dataTests=$this->Test_model->obtenerTestsUsu($dataPer,$dataUsu);
       $dataResult= $this->seleccionaUltimaFechaTest($dataTests);
       //continua
       $dataResultTest=array();
       $i=0;
        //data 
        foreach ($dataResult as $test) {
            $dataResultTest[$i]['t_id'] = $test['PK_t_id'];
            $data = @file_get_contents($test['t_respuestas']);
            $items = json_decode($data, true);            
            $dataResultTest[$i]['t_respuestas'] = $items;
            $dataResultTest[$i]['t_fecha'] = $test['t_fecha'];
            $dataResultTest[$i]['t_ansiedadpuntos'] = $test['t_ansiedadpuntos'];
            $dataResultTest[$i]['t_estrespuntos'] = $test['t_estrespuntos'];
            $dataResultTest[$i]['t_depresionpuntos'] = $test['t_depresionpuntos'];
            $i++;
        }

        //echo  base_url(); //produccion
        //enviar la data a la vista con session
        $this->session->set_userdata('dataTest', $dataResultTest);
        //mostrar data
        redirect('doctor/estadisticaResultadoDoctorAEE', 'refresh');
    }

    public function estadisticaResultadoDoctorAEE(){
        $this->load->view('doctor/templatesDoc/header');
		$this->load->view('doctor/resultadoEstadisticaDoctor');
        $this->load->view('doctor/templatesDoc/footer');
    }

    public function seleccionaUltimaFechaTest($dataTests){
        $i=0;
        $a=false;
        $dataResultadoTest=array();
        while ($a == false) {
            $dataTestProcess = $dataTests[$i];
            if($i+1 == count($dataTests)){
                array_push($dataResultadoTest,$dataTestProcess);
                $a=true;
            }elseif($dataTestProcess['t_fecha'] != $dataTests[$i+1]['t_fecha']){
                array_push($dataResultadoTest,$dataTestProcess);
            }
            $i++;    
        }
        return $dataResultadoTest;
    }


    
    public function logoutDoctor(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
	}
    
}
