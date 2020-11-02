<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$dataDoctores = $this->session->userdata('dataDoctores');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
?>
  <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo site_url();?>registrar/estadisticaResultadoUsuProcess">Resultados por dia</a></li>
            <li><a href="<?php echo site_url();?>registrar/preguntasUsuario">Cuestionario</a></li>
            <li><a href="#">Ingresar</a></li>
            <li><a href="badges.html">Registrate</a></li>
            <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
        </ul>
        </div>
    </nav>
  </div>
<div class="container">
    <div class="row">
        <?php
            foreach ($dataDoctores as $doctor) {
        ?>
            <div class="col s12 m6">
                <h2 class="header"><?php echo $doctor['d_nombre'].' '.$doctor['d_apellido']  ?></h2>
                <div class="card horizontal">
                <div class="card-image">
                    <img src="https://lorempixel.com/100/190/nature/6">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                    <p><?php echo $doctor['d_telefono']  ?></p>
                    </div>
                    <div class="card-action">
                    <a href="<?php echo site_url() ?>DoctorUsuario/eligeDoctorProcess/<?php  echo $doctor['PK_d_id'].'/'.$doctor['FK_d_p_id']?>">Elige Doctor</a>
                    </div>
                </div>
                </div>
            </div>            

        <?php
            }
        ?>      
    </div>
</div>