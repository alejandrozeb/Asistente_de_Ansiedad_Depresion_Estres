<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
?>
<div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading">Login Usuario</div>
                  <div class="panel-body">
                      <?php echo form_open(''); //link al url del controlador que recibe los datos?>
                      <div class="form-group">
                        <!-- pregunta Ini -->
                        <label class="flow-text" for="group1">No conseguí tener ningún sentimiento positivo</label>
                        <p>
                            <label>
                                <input class="with-gap" name="group1" type="radio" />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="group1" type="radio"  />
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="group1" type="radio" />
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="group1" type="radio" />
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta Ini -->
                        <label class="flow-text" for="group2">Me fue difícil tomar iniciativa para hacer cosas</label>
                        <p>
                            <label>
                                <input class="with-gap" name="group2" type="radio" />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="group2" type="radio"/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="group2" type="radio"/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="group2" type="radio"/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="group2">Me fue difícil tomar iniciativa para hacer cosas</label>
                        <p>
                            <label>
                                <input class="with-gap" name="group2" type="radio" />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="group2" type="radio"/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="group2" type="radio"/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="group2" type="radio"/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->

                      <div class="form-group">
                          <input type="submit" name="u_login" value="Registrar" class="btn btn-success btn-sm" required>
                          <a href="<?php echo site_url('home');?>" class="btn btn-warning btn-sm">Iniciar sesión</a>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div>
      </div>
    </div>