<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrar extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Usuario_model');
        $this->load->model('Test_model');
        $this->load->helper('path');

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
        /* ansiedad */
        $u_pre1=$this->input->post('u_pre1');
        $u_pre2=$this->input->post('u_pre2');
        $u_pre3=$this->input->post('u_pre3');
        $u_pre4=$this->input->post('u_pre4');
        $u_pre5=$this->input->post('u_pre5');
        $u_pre6=$this->input->post('u_pre6');
        $u_pre7=$this->input->post('u_pre7');
        /* depresion */
        $u_pre8=$this->input->post('u_pre8');
        $u_pre9=$this->input->post('u_pre9');
        $u_pre10=$this->input->post('u_pre10');
        $u_pre11=$this->input->post('u_pre11');
        $u_pre12=$this->input->post('u_pre12');
        $u_pre13=$this->input->post('u_pre13');
        $u_pre14=$this->input->post('u_pre14');
        /* estres */
        $u_pre15=$this->input->post('u_pre15');
        $u_pre16=$this->input->post('u_pre16');
        $u_pre17=$this->input->post('u_pre17');
        $u_pre18=$this->input->post('u_pre18');
        $u_pre19=$this->input->post('u_pre19');
        $u_pre20=$this->input->post('u_pre20');
        $u_pre21=$this->input->post('u_pre21');

        $arrayRespuestas = array(
            'pre1' => $u_pre1,
            'pre2' => $u_pre2,
            'pre3' => $u_pre3,
            'pre4' => $u_pre4,
            'pre5' => $u_pre5,
            'pre6' => $u_pre6,
            'pre7' => $u_pre7,
            'pre8' => $u_pre8,
            'pre9' => $u_pre9,
            'pre10' => $u_pre10,
            'pre11' => $u_pre11,
            'pre12' => $u_pre12,
            'pre13' => $u_pre13,
            'pre14' => $u_pre14,
            'pre15' => $u_pre15,
            'pre16' => $u_pre16,
            'pre17' => $u_pre17,
            'pre18' => $u_pre18,
            'pre19' => $u_pre19,
            'pre20' => $u_pre20,
            'pre21' => $u_pre21
        );
        //crear directorio
        $this->crearDirectorio($idPer_sesion,$idUsu_sesion);
        //crear json
        $date=date('Y-m-d-H-i-s');
        $dir=$this->crearJson($arrayRespuestas,$idPer_sesion,$idUsu_sesion,$date);
        //calculos
        $ansiedad_result=$u_pre1+$u_pre2+$u_pre3+$u_pre4+$u_pre5+$u_pre6+$u_pre7;
        $depresion_result=$u_pre8+$u_pre9+$u_pre10+$u_pre11+$u_pre12+$u_pre13+$u_pre14;
        $estres_result=$u_pre15+$u_pre16+$u_pre17+$u_pre18+$u_pre19+$u_pre20+$u_pre21;;

        $usuario_resultados = array(
            't_respuestas' => $dir,
            't_fecha' => $date,
            't_ansiedadpuntos' => $ansiedad_result,
            't_depresionpuntos' => $depresion_result,
            't_estrespuntos' => $estres_result,
            'FK_p_id' =>$idPer_sesion,
            'FK_u_id' =>$idUsu_sesion
        );
        //guardar en bd
        if(!$this->Test_model->insertarTest($usuario_resultados)){
            $this->output->set_status_header(500);
            echo "Error al insertar";
            redirect('registrar/preguntasUsuario', 'refresh');
            exit;
        }else{
            //desplegar vista de resultados
            $ansiedadData=$this->ansiedadUsuProceso($ansiedad_result);
            $depresionData=$this->depresionUsuProceso($depresion_result);
            $estresData=$this->estresUsuProceso($estres_result);
            //desplegar
            $data=array(
                'ansiedad' => $ansiedadData,
                'depresion' => $depresionData,
                'estres' => $estresData,
            );
            $this->session->set_userdata('data', $data);
            redirect('registrar/resultadoUsuarioAEE', 'refresh');
        }    
    }

    public function resultadoUsuarioAEE(){
        $this->load->view('usuario/templatesUsu/header');
		$this->load->view('usuario/resultadoUsu');
        $this->load->view('usuario/templatesUsu/footer');
    }
    public function estadisticaResultadoUsuProcess(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $dataTests=$this->Test_model->obtenerTestsUsu($idPer_sesion,$idUsu_sesion);
        /* sacamos el ultimo de cada fecha */
       $dataResult= $this->seleccionaUltimaFechaTest($dataTests);
       $dataResultTest=array();
       $i=0;
        //data 
        foreach ($dataResult as $test) {
            $dataResultTest[$i]['t_fecha'] = $test['t_fecha'];
            $dataResultTest[$i]['t_ansiedadpuntos'] = $test['t_ansiedadpuntos'];
            $dataResultTest[$i]['t_estrespuntos'] = $test['t_estrespuntos'];
            $dataResultTest[$i]['t_depresionpuntos'] = $test['t_depresionpuntos'];
            $i++;
        }
        //enviar la data a la vista con session
        $this->session->set_userdata('dataTest', $dataResultTest);
        //mostrar data
        redirect('registrar/estadisticaResultadoUsu', 'refresh');
    }
    public function estadisticaResultadoUsu(){
        $this->load->view('usuario/estadisticaResultado.php');
        $this->load->view('usuario/templatesUsu/footer');
    }
    public function ultimaRespuestaUsu(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
        $dataLastTest=$this->Test_model->obtenerUltimoTestUsu($idPer_sesion,$idUsu_sesion);
            $ansiedadData=$this->ansiedadUsuProceso($dataLastTest->t_ansiedadpuntos);
            $depresionData=$this->depresionUsuProceso($dataLastTest->t_depresionpuntos);
            $estresData=$this->estresUsuProceso($dataLastTest->t_estrespuntos);
            //desplegar
            $data=array(
                'ansiedad' => $ansiedadData,
                'depresion' => $depresionData,
                'estres' => $estresData,
            );
            $this->session->set_userdata('data', $data);
            redirect('registrar/resultadoUsuarioAEE', 'refresh');

    }

    public function verificaDoctor(){
        $idPer_sesion = $this->session->userdata('persona');
        $idUsu_sesion = $this->session->userdata('usuario');
        if($idPer_sesion==null || $idUsu_sesion==null){
            redirect('registrar/ingresaUsuario','refresh');
        }
    }
    //devuelve la ruta completa o la ruta creada con el .
    public function crearDirectorio($idPer_sesion,$idUsu_sesion){
        //devolver ruta
        $dir=set_realpath('./resultados/'.$idPer_sesion.$idUsu_sesion."/");
        if(!is_dir($dir)){ 
            mkdir($dir,777);
        }
        return $dir;
    }
    public function crearJson($arrayRespuestas,$idPer_sesion,$idUsu_sesion,$date){
        $json_string = json_encode($arrayRespuestas);
        $file = './resultados/'.$idPer_sesion.$idUsu_sesion.'/'.$idPer_sesion.$idUsu_sesion.$date.'resp.json';
        file_put_contents($file, $json_string);
        return $file;
    }
    public function ansiedadUsuProceso($ansiedad){
        $resultado;
        if($ansiedad <=3){
            $resultado = array(
                'resultado' => 'No se detecto',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if ($ansiedad == 4){
            $resultado = array(
                'resultado' => 'Leve',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($ansiedad >= 5 && $ansiedad <= 7){
            $resultado = array(
                'resultado' => 'Moderada',
                'respuesta' => 'explicacion del nivel',
                'consejo' => 'consejo de que deberia hacer',
            );
        }else if($ansiedad >= 8 && $ansiedad <= 9){
            $resultado = array(
                'resultado' => 'Severa',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($ansiedad >= 10){
            $resultado = array(
                'resultado' => 'Extremadamente severo',
                'respuesta' => '',
                'consejo' => '',
            );
        }
        return $resultado;
    }
    public function depresionUsuProceso($depresion){
        $resultado;
        if($depresion<=4){
            $resultado = array(
                'resultado' => 'No se detecto',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if ($depresion >= 5 && $depresion <= 6 ){
            $resultado = array(
                'resultado' => 'Leve',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($depresion >= 7 && $depresion <= 10){
            $resultado = array(
                'resultado' => 'Moderada',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($depresion >= 11 && $depresion <= 13){
            $resultado = array(
                'resultado' => 'Severa',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($depresion >= 14){
            $resultado = array(
                'resultado' => 'Extremadamente severo',
                'respuesta' => '',
                'consejo' => '',
            );
        }
        return $resultado;
    }
    public function estresUsuProceso($estres){
        $resultado;
        if($estres <= 7){
            $resultado = array(
                'resultado' => 'No se detecto',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if ($estres >= 8 && $estres <= 9 ){
            $resultado = array(
                'resultado' => 'Leve',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($estres >= 10 && $estres <= 12){
            $resultado = array(
                'resultado' => 'Moderada',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($estres >= 13 && $estres <= 16){
            $resultado = array(
                'resultado' => 'Severa',
                'respuesta' => '',
                'consejo' => '',
            );
        }else if($estres >= 17){
            $resultado = array(
                'resultado' => 'Extremadamente severo',
                'respuesta' => '',
                'consejo' => '',
            );
        }
        return $resultado;
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

    public function logoutUsuario(){
		session_unset();
		session_destroy();
		redirect('home','refresh');
    }
}