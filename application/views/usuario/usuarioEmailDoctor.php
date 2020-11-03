<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$dataDoctor = $this->session->userdata('dataDoctor');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
//var_dump($dataDoctor);
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
          <div class="col s12 m6">
          <h2 class="header"><?php echo $dataDoctor['d_nombre'].' '.$dataDoctor['d_apellido']  ?></h2>
                <div class="card horizontal">
                  <div class="card-image">
                      <img src="https://lorempixel.com/100/190/nature/6">
                  </div>
                  <div class="card-stacked">
                    <div class="card-content">
                      <p><?php echo $dataDoctor['d_telefono']  ?></p>
                    </div>
                  </div>
                </div>         
          </div> 
          <div class="col s12">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading">Enviar Email</div>
                  <div class="panel-body">
                      <?php echo form_open(''); //link al url del controlador que recibe los datos?>
                      <div class="row">
                        <div class="input-field col s6">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="icon_prefix" type="text" class="validate">
                          <label for="icon_prefix">First Name</label>
                        </div>
                        <div class="input-field col s6">
                          <i class="material-icons prefix">phone</i>
                          <input id="icon_telephone" type="tel" class="validate">
                          <label for="icon_telephone">Telephone</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="email" type="email" class="validate">
                          <label for="email">Email</label>
                          <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <textarea id="textarea1" class="materialize-textarea"></textarea>
                          <label for="textarea1">Textarea</label>
                        </div>
                      </div>
                      <div class="row">
                          <input type="submit" name="u_login" value="Enviar" class="btn btn-success btn-sm" required>
                          <a href="<?php echo site_url('home');?>" class="btn btn-warning btn-sm">otra accion</a>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div>
    </div>
</div>