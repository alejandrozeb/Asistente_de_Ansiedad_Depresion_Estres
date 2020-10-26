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
            <li><a href="#">Resultados por dia</a></li>
            <li><a href="#">Cuestionario</a></li>
            <li><a href="#">Ingresar</a></li>
            <li><a href="badges.html">Registrate</a></li>
            <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
        </ul>
        </div>
    </nav>
  </div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>askdmaskld</h1>
        </div>
    </div>
</div>