<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    
    <div class="container">
      <div class="row">
          <div class="col-lg-4 col-md-4 col-lg-oush-4 col-md-push-4">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading">Registrar</div>
                  <div class="panel-body">
                      <?php echo form_open('Registrar/registrarUsuario'); //link al url del controlador que recibe los datos?>
                      <div class="form-group">
                          <input type="text" name="u_nombre" class="form-control input-sm" placeholder="Nombre" required>
                      </div>
                      <div class="form-group">
                          <input type="text" name="u_apellido" class="form-control input-sm" placeholder="Apellido" required>
                      </div>
                      <div class="form-group">
                          <input type="date" name="u_date" class="form-control input-sm" placeholder="Fecha de Nacimiento" required>
                      </div>
                      <div class="form-group">
                          <input type="tel" name="u_telefono" class="form-control input-sm" placeholder="Telefono">
                      </div>
                      <div class="form-group"><!-- opcional -->
                          <input type="text" name="u_genero" class="form-control input-sm" placeholder="Genero" required>
                      </div>
                      <div class="form-group">
                          <input type="email" name="p_email" class="form-control input-sm" placeholder="Email" required>
                      </div>
                      <div class="form-group">
                          <input type="password" name="p_password" class="form-control input-sm" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <input type="submit" name="u_registrar" value="Registrar" class="btn btn-success btn-sm" required>
                          <a href="<?php echo site_url('home');?>" class="btn btn-warning btn-sm">Iniciar sesión</a>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div> 
      </div>
    </div>