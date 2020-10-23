<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!$_SESSION['p_id'] && !$_SESSION['u_id']){
    echo 'no tienes acceso';
    //redirect('home','refresh');
}
?>
<div class="container">
    <div class="row">
        <div class="col-12"><h1>Preguntas usuario</h1></div>
    </div>
</div>