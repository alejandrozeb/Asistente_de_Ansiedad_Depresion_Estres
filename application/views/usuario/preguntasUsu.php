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
        <div class="col-12"><h1>Preguntas usuario</h1></div>
    </div>
</div>