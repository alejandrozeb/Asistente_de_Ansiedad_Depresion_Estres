<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$dataTest = $this->session->userdata('data');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
?>
  <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo site_url();?>contacto">Registrar un Contacto</a></li>
            <li><a href="<?php echo site_url();?>registrar/estadisticaResultadoUsuProcess">Resultados por dia</a></li>
            <li><a href="<?php echo site_url();?>registrar/preguntasUsuario">Cuestionario</a></li>
            <li><a href="#">Ingresar</a></li>
            <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
        </ul>
        </div>
    </nav>
  </div>
<div class="container">
    <div class="row">
        <div class="col s12 m12 l6">    
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php echo base_url('imagenes/InfografiaAnsiedad.jpg')?>">
                </div>
                <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Ansiedad<i class="material-icons right">more_vert</i></span>
                <p>Resultados del Test aqui</p>
                </div>
                <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Ansiedad<i class="material-icons right">close</i></span>
                <p>
                    <h2><?php echo $dataTest['ansiedad']['resultado'];?></h2>
                    <p>Respuesta : <?php echo $dataTest['ansiedad']['respuesta']; ?> </p>
                    <p>Consejo : <?php echo $dataTest['ansiedad']['consejo']; ?> </p>
                </p>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l6">
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php echo base_url('imagenes/InfografiaDepresion.jpg')?>">
                </div>
                <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Depresión<i class="material-icons right">more_vert</i></span>
                <p>Resultados del Test aqui</p>
                </div>
                <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Depresión<i class="material-icons right">close</i></span>
                <p>
                    <h3><?php echo $dataTest['depresion']['resultado'];?></h3>
                    <p>Respuesta : <?php echo $dataTest['depresion']['respuesta']; ?> </p>
                    <p>Consejo : <?php echo $dataTest['depresion']['consejo']; ?> </p>
                </p>
                </div>
            </div>
        </div>  
    </div>
    <div class="row">
        <div class="col s12 m12 l6">
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php echo base_url('imagenes/InfografiaEstres2.png')?>">
                </div>
                <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Estres<i class="material-icons right">more_vert</i></span>
                <p>Resultados del Test aqui</p>
                </div>
                <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Estres<i class="material-icons right">close</i></span>
                <p>
                    <h2><?php echo $dataTest['estres']['resultado'];?></h2>
                    <p>Respuesta : <?php echo $dataTest['estres']['respuesta']; ?> </p>
                    <p>Consejo : <?php echo $dataTest['estres']['consejo']; ?> </p>
                </p>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l6">
            <div class="card">
                <div class="card-image">
                <img src="<?php echo base_url('imagenes/saludMental.jpg')?>">
                <span class="card-title">¿Buscas ayuda?</span>
                </div>
                <div class="card-content">
                <p>Contacta con un profesional</p>
                </div>
                <div class="card-action">
                <a class="blue-text" href="<?php echo site_url();?>doctorUsuario/verificaDoctor">Contacta con un doctor aqui</a>
                </div>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a href="#" class="btn-floating btn-large red" >
                <i class="large material-icons">mode_edit</i>
            </a>
        </div>
    </div>
</div>