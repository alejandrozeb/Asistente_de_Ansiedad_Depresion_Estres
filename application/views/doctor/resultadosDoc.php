<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idDoc_sesion = $this->session->userdata('doctor');
$dataPacientes = $this->session->userdata('dataPacientes');
if($idPer_sesion==null || $idDoc_sesion==null){
    redirect('doctor/ingresaDoctor','refresh');
}
?>
  <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">AsistenteAEE</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="sass.html">Ingresar</a></li>
            <li><a href="badges.html">Registrate</a></li>
            <li><a href="<?php echo site_url();?>doctor/logoutDoctor">Logout</a></li>
        </ul>
        </div>
    </nav>
  </div>
<div class="container">
    <div class="row">
        <div class="col-12"><h1>Mostrar sus pacientes</h1></div>
        <?php
            if($dataPacientes!=null){
            foreach ($dataPacientes as $Paciente) {
                var_dump($Paciente);
        ?>
            <div class="row">
                <div class="col s12 m6">
                <div class="card ">
                    <div class="card-content black-text">
                    <span class="card-title"> Paciente: <?php echo $Paciente['u_nombre'].' '.$Paciente['u_apellido'];?></span>
                    <p><?php echo $Paciente['p_email'];  ?></p>
                    <p><?php echo $Paciente['u_telefono']; ?></p>
                    <p><?php echo $Paciente['u_fechanac']; ?></p>
                    <p><?php echo $Paciente['u_sexo']; ?></p>
                    </div>
                    <div class="card-action">
                    <a href="<?php echo site_url() ?>Doctor/estadisticaResultadoUsuProcess/<?php  echo $Paciente['PK_p_id'].'/'.$Paciente['Pk_u_id']?> ">Resultados pruebas</a>
                    </div>
                </div>
                </div>
            </div>                   
        <?php
            }}else{
        ?>
            <h2>No tienes Pacientes</h2>
        <?php
            }
        ?>     
    </div>
</div>