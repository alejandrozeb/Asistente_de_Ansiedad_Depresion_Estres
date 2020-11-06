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
    </div>
</div>