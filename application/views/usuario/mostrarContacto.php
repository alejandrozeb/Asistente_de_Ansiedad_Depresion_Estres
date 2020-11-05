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
        <a href="#" class="brand-logo">Asistente AEE</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Registrar un Contacto</a></li>
            <li><a href="<?php echo site_url();?>registrar/estadisticaResultadoUsuProcess">Resultados por dia</a></li>
            <li><a href="<?php echo site_url();?>registrar/preguntasUsuario">Cuestionario</a></li>
            <li><a href="#">Ingresar</a></li>
            <li><a href="<?php echo site_url();?>contacto/logoutContacto">LogOut</a></li>
        </ul>
        </div>
    </nav>
  </div>


  <div class="container">
      <div class="row">
          <div class="col-lg-4 col-md-4 col-lg-oush-4 col-md-push-4">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading">Registrar Contacto</div>
                  <div class="panel-body">
                      <?php echo form_open('contacto/registrarContacto'); //link al url del controlador que recibe los datos?>
                      <div class="form-group">
                          <input type="text" name="c_nombre" class="form-control input-sm" placeholder="Nombre" required>
                      </div>
                      <div class="form-group">
                          <input type="text" name="c_apellido" class="form-control input-sm" placeholder="Apellido" required>
                      </div>
                      <div class="form-group">
                          <input type="email" name="c_email" class="form-control input-sm" placeholder="Email de contacto" required>
                      </div>
                      <div class="form-group">
                          <input type="submit" name="c_registrar" value="Registrar Contacto" class="btn btn-success btn-sm" required>
                          <!-- <a href="<?php echo site_url('home');?>" class="btn btn-warning btn-sm">Iniciar sesión</a> -->
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div> 
      </div>
      <div>
          <h1>consejo</h1>
      </div>
    </div>

