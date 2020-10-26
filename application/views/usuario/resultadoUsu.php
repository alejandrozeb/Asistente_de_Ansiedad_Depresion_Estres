<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$data = $this->session->userdata('data');
var_dump($data);
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>askdmaskld</h1>
        </div>
    </div>
</div>