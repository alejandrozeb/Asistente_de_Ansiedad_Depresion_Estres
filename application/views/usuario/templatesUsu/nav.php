<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* if(!$_SESSION['p_id'] && !$_SESSION['u_id']){
    //echo 'no tienes acceso';
    redirect('home','refresh');
} */
?>
  <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Ingresar</a></li>
            <li><a href="badges.html">Registrate</a></li>
            <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
        </ul>
        </div>
    </nav>
  </div>
    