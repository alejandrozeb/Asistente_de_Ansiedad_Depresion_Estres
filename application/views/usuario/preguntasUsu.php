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
            <li><a href="<?php echo site_url();?>registrar/ultimaRespuestaUsu">Ultimo Resultado</a></li>
            <li><a href="#">Doctor</a></li>
            <li><a href="badges.html">Registrate</a></li>
            <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
        </ul>
        </div>
    </nav>
  </div>
<div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="panel panel-default" style="margin-top: 50px">
                  <div class="panel-heading flow-text">Cuestionario</div>
                  <div class="panel-body">
                      <?php echo form_open('/registrar/preguntasUsuarioProceso'); //link al url del controlador que recibe los datos?>
                      <div class="form-group">
                        <!-- pregunta Ini -->
                        <label class="flow-text" for="u_pre1">No conseguí tener ningún sentimiento positivo</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre1" type="radio" value='0' required/>
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre1" type="radio"  value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre1" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre1" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta Ini -->
                        <label class="flow-text" for="u_pre2">Me fue difícil tomar iniciativa para hacer cosas</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre2" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre2" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre2" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre2" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre3">Sentí que no había nada que me hiciese andar para adelante (tener expectativas positivas)</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre3" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre3" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre3" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre3" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre4">Me sentí triste y deprimido</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre4" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre4" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre4" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre4" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre5">No conseguí entusiasmarme con nada</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre5" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre5" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre5" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre5" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre6">Sentí que no valía mucho como persona</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre6" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre6" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre6" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre6" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre8">Sentí que la vida no tenía ningún sentido</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre7" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre7" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre7" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre7" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- ****** -->
                        <!-- ***** -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre8">Me di cuenta que tenía la boca seca</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre8" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre8" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre8" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre8" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre9">Sentí dificultad en respirar (ej: respiración excesivamente rápida o falta de respiración en la ausencia de esfuerzo físico)</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre9" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre9" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre9" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre9" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre10">Sentí temblores (por ejemplo, de las manos o de las piernas)</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre10" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre10" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre10" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre10" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre11">Me preocupe con situaciones en que podría sentir pánico y hacer un papel ridículo</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre11" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre11" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre11" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre11" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre12">Estuve cerca de entrar en pánico</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre12" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre12" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre12" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre12" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre13">Sentí el latido de mi corazón inclusive cuando no hacía esfuerzo físico (ej. Corazón acelerado o fallas en el latido del corazón)</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre13" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre13" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre13" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre13" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre14">Tuve miedo sin una buena razón para eso</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre14" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre14" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre14" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre14" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- *********** -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre15">Tuve dificultades en calmarme/no sentir presión.</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre15" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre15" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre15" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre15" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre16">Tuve tendencia para reaccionar exageradamente en ciertas situaciones</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre16" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre16" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre16" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre16" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre17">Me sentí muy nervioso </label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre17" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre17" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre17" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre17" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre18">Sentí que estaba agitado</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre18" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre18" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre18" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre18" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre19">Sentí dificultad en relajar </label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre19" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre19" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre19" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre19" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                        <label class="flow-text" for="u_pre20">Fui intolerante cuando cualquier cosa me impedía realizar lo que estaba para hacer</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre20" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre20" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre20" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre20" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                        <!-- pregunta ini -->
                       <label class="flow-text" for="u_pre21">Sentí que andaba muy irritable.</label>
                        <p>
                            <label>
                                <input class="with-gap" name="u_pre21" type="radio" value='0' required />
                                <span>Totalmente en desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre21" type="radio" value='1' required/>
                                <span>En desacuerdo</span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre21" type="radio" value='2' required/>
                                <span>De acuerdo </span>
                            </label>
                            <label >
                                <input class="with-gap" name="u_pre21" type="radio" value='3' required/>
                                <span>Totalmente de acuerdo</span>
                            </label>
                        </p>
                        <!-- pregunta fin -->
                      </div>
                      <div class="form-group">
                          <input type="submit" name="u_preguntas" value="Enviar respuestas" class="btn btn-success btn-sm" required>
                          <a href="<?php echo site_url('home');?>" class="btn btn-warning btn-sm">Limpiar respuestas</a>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div>
      </div>
</div>