<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    
    <div class="container">
      <div class="row">
          <div class="col-lg-4 col-md-4 col-lg-oush-4 col-md-push-4">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading">Login Doctor</div>
                  <div class="panel-body">
                      <?php echo form_open('Doctor/ingresarDocProceso'); //link al url del controlador que recibe los datos?>
                      <div class="form-group">
                          <input type="email" name="p_email" class="form-control input-sm" placeholder="Email" required>
                      </div>
                      <div class="form-group">
                          <input type="password" name="p_password" class="form-control input-sm" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <input type="submit" name="d_login" value="Registrar" class="btn btn-success btn-sm" required>
                          <a href="<?php echo site_url('home');?>" class="btn btn-warning btn-sm">Iniciar sesión</a>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12">sadasd</div>
          <div class="col-12">sadasd</div>
          <div class="col-12">sadasd</div>
          <div class="col-12">sadasd</div>
          <div class="col-12">sadasd</div>
          <div class="col-12">sadasd</div>
      </div>
    </div>