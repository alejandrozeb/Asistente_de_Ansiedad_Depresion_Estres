<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$dataContacto = $this->session->userdata('dataContacto');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
//var_dump($dataContacto);
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
            <div class="col s12 m8">
                <h2 class="header">Contacto de Emergencia</h2>
                <div class="card horizontal">
                <div class="card-image">
                    <img src="https://lorempixel.com/100/190/nature/6">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                    <p><?php echo $dataContacto->c_nombre.' '.$dataContacto->c_apellido;   ?></p>
                    <p><?php echo $dataContacto->c_email;  ?></p>
                    <p>Si necesitas ayuda urgente podras contactarte con esta persona</p>
                    </div>
                </div>
                </div>
            </div>
    </div>
</div>

  <div class="container">
      <div class="row">
      <h2 class="header">Actualiza sus Datos</h2>
          <div class="col-lg-5 col-md-4 col-lg-oush-4 col-md-push-4">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading">Contacto</div>
                  <div class="panel-body">
                      <?php echo form_open('contacto/actualizarContacto'); //link al url del controlador que recibe los datos?>
                      <div class="form-group">
                          <input type="text" name="c_nombre" class="form-control input-sm" placeholder="Nombre" value="<?php echo $dataContacto->c_nombre;?>" required>
                      </div>
                      <div class="form-group">
                          <input type="text" name="c_apellido" class="form-control input-sm" placeholder="Apellido" value="<?php echo $dataContacto->c_apellido;?>" required>
                      </div>
                      <div class="form-group">
                          <input type="email" name="c_email" class="form-control input-sm" placeholder="Email de contacto" value="<?php echo $dataContacto->c_email;?>" required>
                      </div>
                      <div class="form-group">
                          <input type="submit" name="c_actualizarContacto" value="Actualizar Contacto" class="btn btn-success btn-sm" required>
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

