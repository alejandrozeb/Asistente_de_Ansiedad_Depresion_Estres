<header>
      <div class="container">
        <div class="row my-4">
          <div class="col-12 text-center">
              <img class="responsive-img" src="<?php echo base_url('imagenes/home4.jpg')?>">
          </div>
        </div>
      </div>
</header>
<main>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="center-align">Asistente AEE</h1>
                <p class="flow-text">Plataforma desarrollada para llevar el control de tu ansiedad, estrés y depresión según la herramienta Dass-21.</p>
            </div>
        </div>
        <?php echo base_url().'<br>';
              echo site_url();   ?>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="<?php echo base_url('imagenes/home5.jpg')?>">
                    </div>
                    <div class="card-content">
                    <span class="card-title grey-text text-darken-4">Usuario</span>
                        <p>Podrás llenar el cuestionario y ver tus niveles de Ansiedad, estrés y depresión además podrás contactar con un profesional que podrá ayudarte.<br>
                        Podrás registrar un contacto de emergencia para poder pedir ayuda.</p>
                    </div>
                    <div class="card-action">
                    <p><a href="<?php echo site_url();?>registrar/" class="waves-effect waves-light btn" >Registrate como usuario</a>      <a href="<?php echo site_url();?>registrar/ingresaUsuario" class="waves-effect waves-light btn">Ingresa como usuario</a></p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="<?php echo base_url('imagenes/home6.jpg')?>">
                    </div>
                    <div class="card-content">
                    <span class="card-title grey-text text-darken-4">Consejero</span>
                        <p>Regístrate si tienes conocimientos y ganas de ayudar a personas que te necesitan.</p>
                    </div>
                    <div class="card-action">
                        <p><a href="<?php echo site_url();?>doctor" class="waves-effect waves-light btn" >Registrate como consejero</a></p>
                        <p><a href="<?php echo site_url();?>doctor/ingresaDoctor" class="waves-effect waves-light btn">Ingresa como consejero</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>