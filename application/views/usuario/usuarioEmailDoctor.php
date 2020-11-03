<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
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
        

    </div>
</div>